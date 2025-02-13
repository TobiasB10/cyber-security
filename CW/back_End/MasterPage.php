<?php

class HTMLPage
{
    private $title;
    private $content;

    public function __construct($title)
    {
        $this->title = $title;
        $this->content = '';
    }

    public function setContent($content)
    {
        $this->content = $content;
    }

    public function createPage()
    {
        return <<<HTML
<!DOCTYPE html>
    <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>{$this->title}</title>
            <link rel="stylesheet" href="/CW/css/bootstrap.css">
            <link rel="stylesheet" href="/CW/css/bootstrap.min.css">
            <link rel="stylesheet" href="/CW/css/site.css">
            <link href="https://fonts.googleapis.com/css2?family=Jost:wght@500&display=swap" rel="stylesheet">
        </head>
        <body>
            {$this->content}
        </body>
    </html>
HTML;
    }
}

class MasterPage
{
    private $masterContent;
    private $_htmlpage;   

    function __construct($title)
    {
        $this->_htmlpage = new HTMLPage($title);
    }

    public function createPage()
    {
        $this->setMasterContent();
        $this->_htmlpage->setContent($this->masterContent);

        return $this->_htmlpage->createPage();
    }

    private function setMasterContent()
    {
        session_start();
            if (!isset($_SESSION['id'])) {

        $this->masterContent = <<<Master
            <nav class="navbar navbar-expand-lg bg-light" data-bs-theme="light">
                <div class="container-fluid">
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarColor03" aria-controls="navbarColor03" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarColor03">
                        <ul class="navbar-nav me-auto">
                            <li class="nav-item">
                                <a class="nav-link active" href="index.php">Home
                                    <span class="visually-hidden">(current)</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="Create_Blog.php">Create a blog</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="login.php">login/Register</a>
                            </li>
                        </ul>
                        <form class="d-flex">
                            <input class="form-control me-sm-2" type="search" placeholder="Search">
                            <button class="btn btn-secondary my-2 my-sm-0" type="submit">Search</button>
                        </form>
                    </div>
                </div>
            </nav>
    Master;
        }
    else
    {
        $this->masterContent = <<<Master
        <nav class="navbar navbar-expand-lg bg-light" data-bs-theme="light">
            <div class="container-fluid">
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarColor03" aria-controls="navbarColor03" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarColor03">
                    <ul class="navbar-nav me-auto">
                        <li class="nav-item">
                            <a class="nav-link active" href="index.php">Home
                                <span class="visually-hidden">(current)</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="Create_Blog.php">Create a blog</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="profile.php">profile</a>
                        </li>
                    </ul>
                    <form class="d-flex">
                        <input class="form-control me-sm-2" type="search" placeholder="Search">
                        <button class="btn btn-secondary my-2 my-sm-0" type="submit">Search</button>
                    </form>
                </div>
            </div>
        </nav>
    Master;
    }
    }
}
?>