<?php

/** 
 * Get the base path
 * 
 * @param string $path
 * 
 * @return string
 */
function basePath($path = '')
{
  return __DIR__ . '/' . $path;
}

/** 
 * Load a view
 * 
 * @param string $name
 * 
 * @return void
 */
function loadView($name, $data = [])
{
  $viewPath = basePath('App/views/' . $name . '.view.php');

  if (file_exists($viewPath)) {
    extract($data);
    require $viewPath;
  } else {
    echo "View not found: " . $viewPath;
  }
}

/** 
 * Load a partial
 * 
 * @param string $name
 * 
 * @return void
 */
function loadPartial($name)
{
  $partialPath = basePath('App/views/partials/' . $name . '.php');

  if (file_exists($partialPath)) {
    require $partialPath;
  } else {
    echo "Partial not found: " . $partialPath;
  }
}

/** 
 * Inspect values - var dump with pre tag
 * 
 * @param mixed $data
 * 
 * @return void
 */
function inspect($data)
{
  echo '<pre>';
  var_dump($data);
  echo '</pre>';
}

/**
 * Inspect values and kill the script - var dump with pre tag
 * 
 * @param mixed $data
 * 
 * @return void
 */
function inspectAndDie($data)
{
  echo '<pre>';
  var_dump($data);
  echo '</pre>';
  die();
}

/**
 * Format salary
 * 
 * @param string $salary
 * 
 * @return string
 */
function formatSalary($salary)
{
  return '$' . number_format($salary, 0, '.', ',');
}

/**
 * Sanitize data
 * 
 * @param string $dirty
 * 
 * @return string
 */
function sanitize($dirty)
{
  return filter_var(trim($dirty), FILTER_SANITIZE_SPECIAL_CHARS);
}

/**
 * Redirects to a given url
 * 
 * @param string url
 * 
 * @return void
 */
function redirect($url)
{
  header("Location: {$url}");
  exit;
}
