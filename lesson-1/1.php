<?php

class Explorer
{
  protected $startDir;
  protected $currentDir;
  protected $iterator;
  protected $breadcrums;

  public function __construct($dir)
  {
    $this->startDir = $dir;
    $this->currentDir = $dir;
    $this->iterator = new DirectoryIterator($dir);
    $this->breadcrums = new SplStack();
    $this->breadcrums->push($this->currentDir);
  }

  public function getCurrentDir()
  {
    echo $this->currentDir;
  }

  public function getFiles()
  {
    foreach ($this->iterator as $dir) {
      echo $dir . PHP_EOL;
    }
  }

  public function changeDir($dir)
  {
    $this->currentDir = "{$this->startDir}/{$dir}";
    $this->iterator = new DirectoryIterator($this->currentDir);
    $this->breadcrums->push($this->currentDir);
  }

  /**
   * @return SplStack
   */
  public function getBreadcrums()
  {
    return $this->breadcrums;
  }

}

$explorer = new Explorer('c:/os');

$explorer->changeDir('domains');
$explorer->getFiles();
var_dump($explorer->getBreadcrums());
