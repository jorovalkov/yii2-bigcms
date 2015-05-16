<?php
/**
 * @link http://www.bigbrush-agency.com/
 * @copyright Copyright (c) 2015 Big Brush Agency ApS
 * @license http://www.bigbrush-agency.com/license/
 */

namespace cms\blocks\text;

use yii\validators\Validator;

/**
 * Block
 *
 * @property bigbrush\big\models\Block $model
 */
class Block extends \bigbrush\big\core\Block
{
    /**
     * Initializes by adding a validation rule to the model of this block.
     */
    public function init()
    {
        $this->model->validators[] = Validator::createValidator('required', $this->model, 'content');
    }

    /**
     * Returns the content of this block
     */
    public function run()
    {
        return $this->render('index', [
            'model' => $this->model,
        ]);
    }

    /**
     * Edits the block.
     *
     * @param Block $model the model for this block.
     * @return string html form ready to be rendered.
     */
    public function edit($model)
    {
        return $this->render('edit', [
            'model' => $model,
        ]);
    }
}
