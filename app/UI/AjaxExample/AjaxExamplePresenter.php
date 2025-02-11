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
    bdump($this->isAjax(), 'signal GenerateNumber01');

    // toto sa nesmie volat ak ajax
    // handle reditectom automaticky nekonci
    // ako action takze sa default nezavola
    // $this->redirect('this');
  }


  public function handleUpdateMessage(string $snippet, string $message): void
  {
    bdump($this->isAjax(), 'signal UpdateMessage');
    $this->template->message = $message;
    $this->redrawControl($snippet);
    // vola aj renderDefault ale ajaxovy a tym padom konci na detault.latte

    // volam sice renderSignal , takze data spracujem inak ako renderDefault ale renderSignal rovnako vykresluje
    $this->setView('signal');
  }


  public function handleGenerateNumber(string $message = ''): void
  {
    bdump($this->isAjax(), 'signal GenerateNumber');
    $this->sendJson([
        'number' => random_int(1, 100),
        'message' => $message,
      ]
    );
  }

  public function renderDefault(): void
  {
    bdump($this->isAjax(), 'render - Default');

    // inou cestou vyplnas $header potom musis
    if(!isset($this->template->message))
    {
      bdump($this->isAjax(), 'render - Default - Empty message');
      $this->template->message = 'RESET';
    }
  }

  public function renderSignal(): void
  {
    bdump($this->isAjax(), 'signal Render');

    // inak spracujes data ako v default view ale vykreslovanie je zhodne ak pre signal aj pre default

    $this->template->setFile(__DIR__ . '/default.latte');
  }
}
