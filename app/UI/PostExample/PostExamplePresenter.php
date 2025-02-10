<?php declare(strict_types=1);

namespace App\UI\PostExample;

use Nette;
use Nette\Application\Attributes\Requires;

/**
 * Class PostExamplePresenter
 *
 * @author Roman Piller
 */
final class PostExamplePresenter extends Nette\Application\UI\Presenter
{
  protected function createComponentTestForm(): Nette\Application\UI\Form
  {
    $form = new Nette\Application\UI\Form();
    $form->addSubmit('delete3', 'Delete3 - nette form postForm - OK')
      ->setHtmlAttribute('form', 'postForm')
      ->setHtmlAttribute('formaction', $this->link('delete3!'));

    $form->addSubmit('delete4', 'Delete4 - nette form getForm')
      ->setHtmlAttribute('form', 'getForm')
      ->setHtmlAttribute('formaction', $this->link('delete4!'));
    return $form;
  }

  public function handleDelete(): void
  {
    bdump($this->getRequest()->getMethod(), 'DELETE');
    $this->redirect('default');
  }

  public function handleDelete2(): void
  {
    bdump($this->getRequest()->getMethod(), 'DELETE2');
    $this->redirect('default');
  }

//  #[Requires(methods: 'POST', sameOrigin: true)]
  public function handleDelete3(): void
  {
    bdump($this->getRequest()->getMethod(), 'DELETE3');
    $this->redirect('default');
  }

//  #[Requires(methods: 'POST', sameOrigin: true)]
  public function handleDelete4(): void
  {
    bdump($this->getRequest()->getMethod(), 'DELETE4');
    $this->redirect('default');
  }
}
