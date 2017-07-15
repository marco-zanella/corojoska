<?php
/**
 * This file is part of Corojoska.
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
namespace Joska\Model;

/**
 * A blog post.
 * 
 * This class follows the Model-View-Controller Pattern.
 * 
 * @author Marco Zanella <mz@openmailbox.org>
 * @copyright 2017 Coro della Joska
 * @package Joska\Model
 */
class Post extends Model {
    /**
     * Returns a brief summary of this post.
     * 
     * Returns the value of the summary field if set, a shortened version
     * of the content otherwise.
     * 
     * @param int $length Maximum length of the summary
     * @return string Summary of this post
     */
    public function getSummary($length = 128) {
        $summary = !empty($this->summary) ? $this->summary : $this->content;
        $summary = strip_tags($summary);
        if (strlen($summary) > $length) {
            $summary = substr($summary, 0, $length - 3) . "...";
        }

        return $summary;
    }
}
