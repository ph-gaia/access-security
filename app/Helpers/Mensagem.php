<?php namespace App\Helpers;

class Mensagem
{

    private static $msg;

    private static function setMsgDefault()
    {
        self::$msg = [
            '000' => 'Erro ao executar operação.',
            '111' => 'Sucesso ao executar operação. <script>resetForm();</script>',
            '001' => 'Sucesso ao executar operação.'
        ];
    }

    public static function showMsg($message, $tipo, $exit = true)
    {
        self::setMsgDefault();
        $msg = '';

        if (isset(self::$msg[$message])) {
            $msg = "<img src='" . asset("/assets/img") . "/icn_alert_" . $tipo . ".png' > " . self::$msg[$message];
        } else {
            $msg = "<img src='" . asset("/assets/img") . "/icn_alert_" . $tipo . ".png' > " . $message;
        }
        echo "<div class='alert alert-{$tipo}'>{$msg}</div>";

        if ($exit) {
            exit;
        }
    }
}
