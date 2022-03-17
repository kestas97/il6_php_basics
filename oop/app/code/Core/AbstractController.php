<?php

declare(strict_types=1);
namespace Core;

use Helper\Url;
use Model\User;
use Model\Message as MessageModel;


class AbstractController
{
    protected array $data;

    public function __construct()
    {
        $this->data = [];
        $this->data['title'] = 'Srotas24/7.lt';
        $this->data['meta_description'] = '';
        if ($this->isUserLogged()){
            $this->data['new_messages'] = MessageModel::getUnreadMessagesCount();
        }
    }
    protected function render($template): void
    {
        include_once PROJECT_ROOT_DIR. '/app/design/parts/header.php';
        include_once PROJECT_ROOT_DIR. '/app/design/'.$template.'.php';
        include_once PROJECT_ROOT_DIR. '/app/design/parts/footer.php';
    }

    protected function renderAdmin($template): void
    {
        include_once PROJECT_ROOT_DIR. '/app/design/admin/parts/header.php';
        include_once PROJECT_ROOT_DIR. '/app/design/admin/'.$template.'.php';
        include_once PROJECT_ROOT_DIR. '/app/design/admin/parts/footer.php';
    }

    protected function isUserLogged(): bool
    {
        return isset($_SESSION['user_id']);
    }

    protected function isUserAdmin(): bool
    {
        if ($this->isUserLogged()) {
            $user = new User();
            $user->load($_SESSION['user_id']);
            if ($user->getRoleId() == 1) {
                return true;

            }
        }

        return false;
    }

    public function url(string $path, ?string $param = null): string
    {
        return Url::link($path, $param);
    }



}
