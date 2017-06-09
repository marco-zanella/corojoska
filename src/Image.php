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
namespace Joska;

/**
 * PHP GD wrapper.
 * 
 * Wraps PHP GD functions into an object, and adds some minor
 * functionalities.
 * 
 * This class follows the Adapter and Decorator Design Patterns and
 * exhibits a Fluent Interface.
 * 
 * @author Marco Zanella <mz@openmailbox.org>
 * @copyright 2017 Coro della Joska
 * @package Joska
 */
class Image {
    /**
     * @var resource $img PHP GD image resource
     */
    protected $img;


    /**
     * Constructor.
     * @param resource $img PHP GD image
     */
    public function __construct($img) {
        $this->setImage($img);
    }



    /**
     * Destructor.
     * 
     * Deallocates PHP GD image (if present).
     */
    public function __destruct() {
        if (gettype($this->img) === 'resource') {
            imagedestroy($this->img);
        }
    }



    /**
     * Calls a PHP GD function on this image.
     * 
     * PHP GD functions follows the naming convention:
     * "image[function name]". By calling the method [function name] on
     * this object, the function "image[function name]" is internally
     * called by this magic method.
     * 
     * Triggers an E_USER_ERROR if given method name does not map onto
     * any PHP GD function.
     * 
     * These methods always modify the image wrapped by this object,
     * without creating a new image (which is a different behavior with
     * respect to some PHP GD functions).
     * 
     * @param string $name Name of the called method
     * @param array $arguments Method arguments
     * @return $this This image itself
     * @throws \Exception If mapped PHP GD function fails
     */
    public function __call($name, $arguments) {
        $function_name = 'image' . $name;

        // Triggers an error if method name does not map onto a PHP GD function
        if (!function_exists($function_name)) {
            trigger_error('Call to undefined method ' . $name, E_USER_ERROR);
        }

        // Adds PHP GD image as parameters and call the function
        array_unshift($arguments, $this->img);
        $result = call_user_func_array($function_name, $arguments);

        // Throws an exception if function failed
        if ($result === false) {
            throw new \Exception($function_name . ' failed.');
        }

        // Updates PHP GD image if necessary
        elseif (gettype($result) === 'resource') {
            $this->setImage($result);
        }

        return $this;
    }



    /**
     * Calls a PHP GD function independent from an image.
     * 
     * PHP GD functions follows the naming convention:
     * "image<function name>". By calling the method <function name> of
     * this class, the function "image<function name>" is internally
     * called by this magic method.
     * 
     * Triggers an E_USER_ERROR if given method name does not map onto
     * any PHP GD function.
     * 
     * @param string $name Name of the called method
     * @param array $arguments Method arguments
     * @return mixed Whathever is returned by called function
     */
    public static function __callStatic($name, $arguments) {
        $function_name = 'image' . $name;

        // Triggers an error if method name does not map onto a PHPGD function
        if (!function_exists($function_name)) {
            trigger_error('Call to undefined method ' . $name, E_USER_ERROR);
        }

        return call_user_func_array($function_name, $arguments);
    }



    /**
     * Returns PHP GD image.
     * 
     * @return resource PHP GD image wrapped by this object
     */
    public function getImage() {
        return $this->img;
    }



    /**
     * Sets PHP GD image.
     * 
     * Any previously set image is destroied before setting the new one.
     * 
     * @param resource $img PHP GD image to set
     * @return $this This image itself
     * @throws \Exception If given parameter is not a valid PHP GD image
     */
    public function setImage($img) {
        // Throws an exception if given image is invalid
        if (gettype($img) !== 'resource') {
            throw new \Exception('Invalid image');
        }

        // Destroys any previously allocated PHP GD image
        if (gettype($this->img) === 'resource') {
            imagedestroy($this->img);
        }
        $this->img = $img;

        return $this;
    }



    /**
     * Crops this image.
     * 
     * Clipping rettangle is centered with respect to the image. Final
     * image will have exactly given width and height.
     * 
     * @param int $width Width of the clipping rectangle
     * @param int $height Height of the clipping rectangle
     * @return $this This image itself
     * @api
     */
    public function crop($width, $height) {
        $old_width = imagesx($this->img);
        $old_height = imagesy($this->img);

        $width = min($width, $old_width);
        $height = min($height, $old_height);

        $new_img = imagecrop($this->img, [
            'x' => round(($old_width - $width) / 2),
            'y' => round(($old_height - $height) / 2),
            'width' => $width,
            'height' => $height
        ]);

        return $this->setImage($new_img);
    }



    /**
     * Desaturates this image.
     * 
     * Converts this image to grayscale.
     * 
     * @return $this This image itself
     * @api
     */
    public function desaturate() {
        imagefilter($this->img, IMG_FILTER_GRAYSCALE);

        return $this;
    }



    /**
     * Resizes this image.
     * 
     * Changes width and height of an image without keeping aspect
     * ratio. Final image will have exactly given width and height.
     * 
     * @param int $width New width of this image
     * @param int $height New height of this image
     * @return $this This image itself
     * @api
     */
    public function resize($width, $height) {
        $old_width = imagesx($this->img);
        $old_height = imagesy($this->img);

        $new_img = imagecreatetruecolor($width, $height);
        imagecopyresampled(
            $new_img, $this->img,
            0, 0,
            0, 0,
            $width, $height,
            $old_width, $old_height
        );

        return $this->setImage($new_img);
    }



    /**
     * Rotates this image.
     * 
     * @param float $angle Rotation angle, in degrees
     * @return $this This image itself
     * @api
     */
    public function rotate($angle) {
        $new_img = imagerotate($this->img, $angle, 0);

        return $this->setImage($new_img);
    }



    /**
     * Scales this image keeping aspect ratio.
     * 
     * Resizes this image so that its new width and height are at least
     * given ones. One of the two may be bigger than specified one in
     * order to keep aspect ratio.
     * 
     * For instance, an image of size 200x100 scaled to 500x200 will have
     * an actual size of 500x250.
     * 
     * @param int $width New width of this image
     * @param int $height New height of this image
     * @return $this This image itself
     * @api
     */
    public function scale($width, $height) {
        $old_width = imagesx($this->img);
        $old_height = imagesy($this->img);

        $ratio_x = $width / $old_width;
        $ratio_y = $height / $old_height;

        if ($ratio_x >= $ratio_y) {
            $height = round($old_height * $ratio_x);
        }
        else {
            $width = round($old_width * $ratio_y);
        }

        return $this->resize($width, $height);
    }



    /**
     * Applies a scaling and a crop.
     * 
     * First scales the image keeping its aspect ratio, then crops it
     * with a clipping rectangle centered with respect to the image. The
     * final image will have exactly given width and height.
     * 
     * This has the same effect of calling scale and crop with the same
     * width and height.
     * 
     * This method is best suited to create images and thumbnails of a
     * given dimension and aspect ratio.
     * 
     * When in doubt about using resize, scale, crop or scaleandcrop,
     * the latter should be preferred.
     * 
     * @param int $width New width of this image
     * @param int $height New height of this image
     * @return $this This image itself
     * @api
     * @see Image::scale() Documentation for scale
     * @see Image::crop() Documentation for crop
     */
    public function scaleandcrop($width, $height) {
        return $this->scale($width, $height)->crop($width, $height);
    }
}
