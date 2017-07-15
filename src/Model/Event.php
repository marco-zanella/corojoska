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
 * An event.
 * 
 * This class follows the Model-View-Controller Pattern.
 * 
 * @author Marco Zanella <mz@openmailbox.org>
 * @copyright 2017 Coro della Joska
 * @package Joska\Model
 */
class Event extends Model {
    /**
     * Returns a brief summary of this event.
     * 
     * Returns the value of the summary field if set, a shortened version
     * of the description otherwise.
     * 
     * @param int $length Maximum length of the summary
     * @return string Summary of this event
     */
    public function getSummary($length = 128) {
        $summary = !empty($this->summary) ? $this->summary : $this->description;
        $summary = strip_tags($summary);
        if (strlen($summary) > $length) {
            $summary = substr($summary, 0, $length - 3) . "...";
        }

        return $summary;
    }
}
