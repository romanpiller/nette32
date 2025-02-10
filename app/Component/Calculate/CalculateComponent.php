<?php declare(strict_types=1);

namespace App\Component\Calculate;

use Nette\Application\UI\Control;
use Nette\Application\UI\Form;

/**
 * Class CalculateComponent
 *
 * @author Roman Piller
 */
final class CalculateComponent extends Control
{
  /** @var callable[] callbacky */
  public array $onSucceeded = [];

  public function __construct(private string $label)
  {

  }
  protected function createComponentForm(): Form
  {
    $form = new Form();

    $form->addInteger('a', 'a');

    $form->addInteger('b', 'b');

    $form->addSubmit('submit', $this->label);

    $form->onSuccess[] = $this->formSucceeded(...);

    return $form;
  }

  // spracovanie komponenty
  protected function formSucceeded(array $values): void
  {
    if($values['a'] === null || $values['b'] === null)
    {
      // ERROR PRESMEROVANIE MIMO KOMPONENTU
      $this->getPresenter()?->redirect('Comp:error');
    }

    // prevolava callbacky matematicku operaciu
    foreach($this->onSucceeded as $callback)
    {
      // prevola callback
      $callback($this, $values);
    }
  }

  public function render(): void
  {
    $this->template->render(__DIR__ . '/calculate.latte');
  }
}
