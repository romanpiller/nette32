<?php declare(strict_types=1);

namespace App\UI\AjaxExample;

use Nette\Application\UI\Presenter;

/**
 * Class AjaxExamplePresenter
 *
 * @author Roman Piller
 */
final class AjaxExamplePresenter extends Presenter
{
  public function handleGenerateNumber01(): void
  {
    bdump($this->isAjax(), 'handleGenerateNumber01');

    // toto sa nesmie volat ak ajax
    // handle reditectom automaticky nekonci
    // ako action takze sa default nezavola
    // $this->redirect('this');
  }

  public function handleUpdateMessage(string $snippet, string $message): void
  {
    bdump($this->isAjax(), 'handleGenerateNumber01');
    $this->template->message = $message;
    $this->redrawControl($snippet);
    // vola aj renderDefault ale ajaxovy
  }

  public function handleGenerateNumber(string $message = ''): void
  {
    bdump($this->isAjax(), 'handleGenerateNumber');
    $this->sendJson([
        'number' => random_int(1, 100),
        'message' => $message,
      ]
    );
  }

  public function renderDefault(): void
  {
    bdump($this->isAjax(), 'renderDefault');

    // inou cestou vyplnas $header potom musis
    if(!isset($this->template->message))
    {
      $this->template->message = 'RESET';
    }
  }
}
