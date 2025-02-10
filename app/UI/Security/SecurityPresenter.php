<?php declare(strict_types=1);

namespace App\UI\Security;

use Nette;

/**
 * Class SecurityPresenter
 *
 * @author Roman Piller
 */
final class SecurityPresenter extends Nette\Application\UI\Presenter
{
  public function renderDefault(): void
  {
    $this->template->searchXXS = '<script>alert("Hacked!")</script>';
  }
}
