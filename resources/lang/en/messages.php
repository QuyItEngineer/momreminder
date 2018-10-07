<?php
/**
 * Created by IntelliJ IDEA.
 * User: macintosh
 * Date: 3/29/18
 * Time: 3:14 PM
 */

return [
    'error_message' => [
        '500' => 'Technical exception',
        '500001' => 'Story script execute fail',
        \App\Exceptions\AppBaseException::ERROR_MODEL_NOT_FOUND => 'Model not found',
        \App\Exceptions\AppBaseException::ERROR_CHARGE_FAIL => 'Charge fail',
        \App\Exceptions\AppBaseException::ERROR_UPDATE_CREDIT_CARD_FAIL => 'Update credit card fail',
    ],
    'get_list_story_successfully' => 'Get list story successfully',
    'story_script_execute_successfully' => 'Story script execute successfully',
    'get_list_chapter_successfully' => 'Get list chapter successfully',
    'get_chapter_detail_successfully' => 'Get chapter detail successfully'
];
