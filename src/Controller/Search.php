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
namespace Joska\Controller;

/**
 * Controller for search page.
 * 
 * This class follows the Model-View-Controller Pattern and exhibits
 * a Fluent Interface.
 * 
 * @author Marco Zanella <mz@openmailbox.org>
 * @copyright 2017 Coro della Joska
 * @package Joska\Controller
 */
class Search extends Controller {
    /**
     * Returns results of a search.
     * 
     * @param array Associative array of additional parameters
     * @return $this This controller itself
     * @api
     */
    public function get($binders = []) {
        $post_mapper = new \Joska\DataMapper\Sql('Post');
        $event_mapper = new \Joska\DataMapper\Sql('Event');

        // Upcoming events and latest posts
        $latest_posts = $post_mapper->search(null, ['created_at' => 'desc'], 3);
        $criteria = new \Joska\DataMapper\MatchCriteria\Sql('date > NOW()', []);
        $upcoming_events = $event_mapper->search($criteria, ['date' => 'asc']);
        
        
        // Standard search page (performs no search)
        if (!isset($_GET['q']) || empty($_GET['q'])) {
            return $this->view('frontend/search-page', [
                'upcoming_events' => $upcoming_events,
                'latest_posts' => $latest_posts
            ]);
        }
        
        
        // Performs a search
        $time_start = microtime(true);
        $query = $_GET['q'];
        $search_engine = new \Joska\SearchEngine\Simple();
        $search_engine->load();
        
        $result = [];
        foreach ($search_engine->search($query) as $item) {
            list($class, $id) = explode('-', $item['id']);
            switch (strtolower($class)) {
                case 'post': $object = $post_mapper->read($id); break;
                case 'event': $object = $event_mapper->read($id); break;
            }
            $object->score = $item['score'];
            
            $result[] = $object;
        }
        $time_end = microtime(true);
        $time = $time_end - $time_start;
        
        return $this->view('frontend/search-page', [
            'query' => $query,
            'result' => $result,
            'query_time' => $time,
            'upcoming_events' => $upcoming_events,
            'latest_posts' => $latest_posts
        ]);
    }
    
    
    
    /**
     * Re-indexes every data.
     * 
     * Forces the search engine to re-index every post and event in the
     * system. Although this is useful during development, it may become
     * slow and time-consuming.
     * 
     * @return $this This controller itself
     */
    private function reindex() {
        $search_engine = new \Joska\SearchEngine\Simple();
        
        // Indexes posts
        $post_mapper = new \Joska\DataMapper\Sql('Post');
        $posts = $post_mapper->search();
        foreach ($posts as $post) {
            $search_engine->index([
                'id' => 'post-' . $post->id,
                'title' => $post->title,
                'summary' => $post->summary,
                'content' => $post->content
            ]);
        }
        
        // Indexes events
        $event_mapper = new \Joska\DataMapper\Sql('Event');
        $events = $event_mapper->search();
        foreach ($events as $event) {
            $search_engine->index([
                'id' => 'event-' . $event->id,
                'name' => $event->name,
                'description' => $event->description
            ]);
        }
        
        // Saves indexed data
        $search_engine->save();
        
        return $this;
    }
}