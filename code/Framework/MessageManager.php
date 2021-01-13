<?php

namespace Framework;

class MessageManager
{
    const TYPE_ERROR = 0;
    const TYPE_SUCCESS = 1;

    public static function addMessage($message, $type = self::TYPE_ERROR)
    {
        if ($type === self::TYPE_ERROR) {
            $_SESSION['errorMessages'][] = $message;
        } elseif ($type === self::TYPE_SUCCESS) {
            $_SESSION['successMessages'][] = $message;
        }
    }

    public static function getMessagesHtml()
    {
        $returnHtml = '';
        if (isset($_SESSION['errorMessages']) && is_array($_SESSION['errorMessages'])) {
            foreach ($_SESSION['errorMessages'] as $errorMessage) {
                $returnHtml .= '<div class="error-message">';
                $returnHtml .= '<span>';
                $returnHtml .= $errorMessage;
                $returnHtml .= '</span>';
                $returnHtml .= '</div>';
            }
        }

        if (isset($_SESSION['successMessages']) && is_array($_SESSION['errorMessages'])) {
            foreach ($_SESSION['successMessages'] as $successMessage) {
                $returnHtml .= '<div class="success-message">';
                $returnHtml .= '<span>';
                $returnHtml .= $successMessage;
                $returnHtml .= '</span>';
                $returnHtml .= '</div>';
            }
        }

        $_SESSION['errorMessages'] = [];
        $_SESSION['successMessages'] = [];

        return $returnHtml;
    }
}
