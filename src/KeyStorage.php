<?php

namespace UIS\EUSPE;

use Exception;

class KeyStorage
{

  private $settingsDir;

  public function __construct(string $settingsDir)
  {
    $this->setSettingsDir($settingsDir);
  }

  private function setSettingsDir(string $settingsDir): void
  {
    $this->settingsDir = $settingsDir;
  }

  public function getSettingsDir(): string
  {
    return $this->settingsDir;
  }

  /**
   * @param User $user
   * @return Key
   * @throws Exception
   */
  public function get(User $user): Key
  {
    $key = new Key();
    $key->setDir("{$this->settingsDir}/{$user->getServerName()}/{$user->getUserName()}");
    $key->configure();
    return $key;
  }

  public function clearExpired(int $ttl = 3600, $time = null): void
  {
    if (null === $time) {
      $time = time();
    }
    $servers = scandir($this->settingsDir);
    foreach ($servers as $server) {
      $serverDir = "{$this->settingsDir}/{$server}";
      if (!is_dir($serverDir) || '.' === $server || '..' === $server) {
        continue;
      }
      $users = scandir($serverDir);
      foreach ($users as $user) {
        $userDir = "{$serverDir}/{$user}";
        if (!is_dir($userDir) || '.' === $user || '..' === $user || ($time - filemtime($userDir) < $ttl)) {
          continue;
        }
        $files = scandir($userDir);
        foreach ($files as $file) {
          if ('.' === $file || '..' === $file) {
            continue;
          }
          unlink("{$userDir}/{$file}");
        }
        rmdir($userDir);
      }
    }
  }
}