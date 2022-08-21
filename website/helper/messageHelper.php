<?php

class MessageHelper{
    public $title;
    public $message;

    public function __construct(string $title, string $message)
    {
        $this->title = $title;
        $this->message = $message;
    }

    public function messageObjHandler()
    {
        MessageHelper::messageHandler($this->title,$this->message);
    }

    public static function messageHandler(string $title, string $message){
        ?>
<article id="messageHelper">
    <h2><?= $title?></h2>
    <p><?= $message?></p>
</article>
<?php
    }

}
?>
