<?php declare(strict_types=1);

namespace App\UI\Comp;

use App\Component\Calculate\CalculateComponent;
use Nette;

/**
 * Class CompPresenter
 *
 * @author Roman Piller
 */
final class CompPresenter extends Nette\Application\UI\Presenter
{


  // pouzije komponentu na sucet
  protected function createComponentSucetForm(): CalculateComponent
  {
    $sucetComponent = new CalculateComponent("Sucet");
    $sucetComponent->onSucceeded [] = function ($component, $values) {
        $this->sucetSucceeded($component, $values);
      };
    return $sucetComponent;
  }


  // pouzije komponentu na podiel
  protected function createComponentPodielForm(): CalculateComponent
  {
    $podielComponent = new CalculateComponent("Podiel");
    $podielComponent->onSucceeded [] = function ($component, $values) {
      $this->podielSucceeded($component, $values);
    };
    return $podielComponent;
  }


  // callback sucet
  public function sucetSucceeded(CalculateComponent $component, array $values): void
  {
    // operacia
    $a = (float)  $values['a'];
    $b = (float)  $values['b'];
    $result = $a + $b;
    $message = "Vysledok suctu {$a} + {$b} = {$result}";

    $this->redirect(':result',  ['message' => $message]);
  }

  // callback podiel
  public function podielSucceeded(CalculateComponent $component, array $values): void
  {
    // operacia
    $a = (float)  $values['a'];
    $b = (float)  $values['b'];
    $result = $a / $b;
    $message = "Vysledok podielu {$a} / {$b} = {$result}";
    $this->redirect(':result',  ['message' => $message]);
  }

  public function renderResult(string $message): void
  {
    $this->template->message = $message;
  }

  public function renderDefault()
  {
    //
  }
}
