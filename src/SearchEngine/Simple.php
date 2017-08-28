<?php
/**
 * This file is part of Corojoska.
 *
 * Corojoska is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * Corojoska is distributed under the hope it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with Corojoska. If not, see <http://www.gnu.org/licenses/>.
 *
 * PHP version 5
 *
 * @author    Marco Zanella <mz@openmailbox.org>
 * @copyright 2017 Coro della Joska
 * @license   GNU General Public License, version 3
 */
namespace Joska\SearchEngine;

/**
 * A simple search engine.
 * 
 * @author Marco Zanella <mz@openmailbox.org>
 * @copyright 2017 Coro della Joska
 * @package Joska\SearchEngine
 */
class Simple implements SearchEngineInterface {
    private $indexed_items = [];
    
    
    /**
     * Processes and indexes a document.
     * 
     * Prepares a document to be used in search operations.
     * 
     * @param array Associative array representing a document.
     * @return $this This search engine itself
     */
    public function index($fields) {
        $id = $fields['id'];
        unset($fields['id']);
        $item = [];
        
        foreach ($fields as $key => $value) {
            $item[$key] = self::process($value);
        }
        $item['id'] = $id;
        $item['indexed_at'] = time();
        
        $this->indexed_items[$id] = $item;
        return $this;
    }
    
    
    /**
     * Removes a document from indexed data.
     * 
     * @param string $id Id of the document to remove
     * @return $this This search engine itself
     */
    public function remove($id) {
        if (isset($this->indexed_items[$id])) {
            unset($this->indexed_items[$id]);
        }
        
        return $this;
    }
    
    
    /**
     * Performs a search.
     * 
     * Searches given query among indexed elements.
     * 
     * @param string $query Query string
     * @return array Array of matching items
     */
    public function search($query, $threshold = 0.05) {
        $processed_query = self::process($query);
    
        $max_score = -1.0;
        $max = 0;
        
        $result = [];
        foreach ($this->indexed_items as $item) {
            $score = self::compare($item, $processed_query);
            $item['score'] = $score;
            
            if ($score > $threshold) {
                $result[] = ['id' => $item['id'], 'score' => $score];
            }
        }
        usort($result, function ($a, $b) { return $a['score'] >= $b['score'] ? -1 : +1; });
        
        return $result;
    }
    
    
    /**
     * Saves data indexed by this search engine.
     * 
     * Exports data to a persistente source identified by a file path.
     * Subsequent instances of the search engine can load data to avoid
     * re-indexing.
     * 
     * @param string $path File path
     * @return $this This search engine itself
     */
    public function save($path = 'public/search-engine/indexed_data.json') {
        file_put_contents($path, json_encode($this->indexed_items));
        
        return $this;
    }
    
    
    /**
     * Loads previously saved indexed data.
     * 
     * Restores index information of a previous instance of this search
     * engine. Resets this search engine to a blank state if file is not
     * readable.
     * 
     * @param string $path File path
     * @return $this This search engine itself
     */
    public function load($path = 'public/search-engine/indexed_data.json') {
        $this->indexed_items = is_readable($path) ? json_decode(file_get_contents($path), true) : [];
        
        return $this;
    }
    
    
    
    /**
     * Computes matching score between a processed query and indexed item.
     * 
     * Matching score is defined as a heuristic which considers the Levenshtein
     * distance between strings, their length, and the number of token in
     * the processed strings.
     * 
     * @param array $index Processed indexed term (array of string tokens)
     * @param array $query Processed query (array of string of tokens)
     * @return float Mathcing score between query and indexed term
     */
    private static function score($index, $query) {
        $score = 0;
        foreach ($index as $index_term) {
            foreach ($query as $query_term) {
                $score += levenshtein($index_term, $query_term) < 1 ? 1 : 0;
            }
        }
        return $score / (log(max(count($index), count($query))) + 1.0);
    }


    /**
     * Computes matching score between an indexed document and a processed
     * query string.
     * 
     * Compares processed query string against every field of an indexed
     * document, combining those matching scores to compute a global score
     * for the document.
     * 
     * The combining operation is a heuristic.
     * 
     * @param array $indexed_item Associative array representing the indexed document
     * @param array $processed_query Processed query (array of string token)
     * @return float Matching score between an indexed document and a query
     */
    private static function compare($indexed_item, $processed_query) {
        $result = [];
        foreach ($indexed_item as $key => $value) {
            if (!is_array($value)) {
                continue;
            }
            $result[$key] = self::score($value, $processed_query);
        }
        return max(array_values($result));
    }
    
    
    /**
     * Transforms a string into a list of string token.
     * 
     * Processes a string making it suitable for indexing and quering
     * operations. The result is a list of string token which can be used
     * for queries of stored as indexed data.
     * 
     * Processing includes standard operations such as removal of HTML tags
     * and entity codes, conversion to lowercase, removal of non alphanumerical
     * characters and removal of stopwords.
     * 
     * Overall, the process is a heuristic.
     * 
     * @param string $string String to process
     * @return array Array of string tokens
     */
    private static function process($string) {
        $stopwords = file('public/search-engine/stopwords.txt', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

        $string = strip_tags($string);
        $string = html_entity_decode($string, ENT_QUOTES, 'UTF-8');
        $string = strtolower($string);
        $string = preg_replace("/[^[:alnum:]]/u", " ", $string);

        $terms = preg_split("/\s+/", $string, -1, PREG_SPLIT_NO_EMPTY);
        $terms = array_diff($terms, $stopwords);

        return $terms;
    }
}