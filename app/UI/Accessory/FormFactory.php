<?php declare(strict_types=1);

namespace App\UI\Accessory;

use Nette\Application\UI\Form;

/**
 * Class FormFactory
 *
 * @author Roman Piller
 */
final class FormFactory
{
  public function createSubmitForm(): Form
  {
    $form = new Form();
    $form->addSubmit('submit', 'Submit');
    $form->addSubmit('cancel', 'Cancel');
    return $form;
  }

  public function createEditForm(): Form
  {
    $form = new Form;
    $form->addText('title', 'Titulek:');
    $form->addSubmit('send', 'Odeslat');
    return $form;
  }
}
