<?php

class MyDirectoryIterator extends DirectoryIterator
{
  public function toArray()
  {
    $arr = [];
    foreach ($this as $value) {
      $arr[] = (string)$value;
    }
    return $arr;
  }
}

class Explorer
{
  protected $path;
  protected $iterator;
  protected $breadcrumbs;

  public function __construct($path)
  {
    $this->iterator = new MyDirectoryIterator($path);
    $this->breadcrumbs = new SplStack();
    $this->breadcrumbs->push($path);
  }

  /**
   * @return MyDirectoryIterator
   */
  public function getIterator()
  {
    return $this->iterator;
  }

  /**
   *
   */
  public function view()
  {
    foreach ($this->iterator as $file) {
      echo $file . PHP_EOL;
    }
  }

  public function run($path)
  {

    $key = array_search($path, $this->iterator->toArray());
    if ($key) {
      $this->iterator->seek($key);
    }
    if ($this->iterator->isDir()) {
      $this->openDir($path);
    } else if ($this->iterator->isFile()) {
      $this->openFile($path);
    } else if ($this->iterator->current() === '..') {
      $this->goBack();
    } else {
      die();
    }
  }

  /**
   * @param $dir
   */

  protected function openDir($dir)
  {
    $newDir = $this->breadcrumbs->top() . '/' . $dir;
    $this->iterator = new MyDirectoryIterator($newDir);
    $this->breadcrumbs->push($newDir);
  }

  protected function goBack()
  {
    $this->breadcrumbs->pop();
    $this->iterator = new MyDirectoryIterator($this->breadcrumbs->top());
  }

  protected function openFile($file)
  {
    $file = new SplFileObject($this->breadcrumbs->top() . '/' . $file);
    echo $file->fpassthru() . PHP_EOL;
  }

  /**
   * @return SplStack
   */
  public function getBreadcrumbs()
  {
    return $this->breadcrumbs;
  }

}

$explorer = new Explorer('c:/os');
$explorer->view();
$explorer->run('gu_php2');
$explorer->run('.gitignore');
$explorer->run('lesson-3');
$explorer->run('models');
$explorer->run('Carts.php');

