<?php declare(strict_types=1);

namespace App\UI\LinkExample;

use App\UI\Accessory\FormFactory;
use Nette;
use Nette\Application\UI\Form;
use Nette\Forms\Controls\SubmitButton;

/**
 * Class LinkExamplePresenter
 *
 * @author Roman Piller
 */
final class LinkExamplePresenter  extends Nette\Application\UI\Presenter
{
  public function __construct(private FormFactory $formFactory)
  {
    parent::__construct();
  }

  public function startup(): void
  {
    parent::startup();

    //sesstion musis nastartovat ak chces vidiet v nette tracy
    $session = $this->session->getSection('my');
    $session->set('uzivatel', 'test');

    bdump($this->session->isStarted(), 'je sesstion nastartovana');
  }

  protected function createComponentEditForm(): Form
  {
    $form = $this->formFactory->createEditForm();
    $form->onSuccess[] = static function()
    {
      ;
    };
    return $form;
  }

  protected function createComponentPostRedirectForm(): Form
  {
    $form = $this->formFactory->createSubmitForm();
    /** @var SubmitButton $submitButton */
    $submitButton = $form->getComponent('submit');
    $submitButton->setCaption('post presmeruj cez submit button');
    $form->onSuccess[] = function()
    {
      $this->actionPresmeruj();
    };
    /** @var SubmitButton $cancelButton */
    $cancelButton  = $form->getComponent('cancel');
    $cancelButton->setCaption('presmeruj na create');
    $cancelButton->setHtmlAttribute('formaction', $this->link('create'));
    return $form;
  }

  public function handlePresmeruj(): void
  {
    // tento po vykonani automaticky nezobrazuje a nejden na latte
    // dosptupny je aj z vonku ako ?do=presmeruj
    bdump('signalPresmeruj');

    // toto zavola actionPresmeruj a tak skoci do presmeruj.latte
    //    $this->redirect('presmeruj');

    // toto vykresli presmeruj.latte - zachova sa ako action
    $this->setView('presmeruj');
  }

  public function actionPresmeruj(): void
  {
    // tento po vykonani automaticky zobrazuje presmeruj.latte
    // a je dostupny aj cez web
    $method = $this->getHttpRequest()->getMethod();
    bdump($method);

    bdump('actionPresmeruj');
//    $this->redirect('signal');
  }

  //---------------------------------------------------------
  public function actionCreate(): void
  {
    bdump('actionCreate');
  }
  public function renderCreate(): void
  {
    bdump('renderCreate');
  }

  //---------------------------------------------------------
  public function renderEdit(): void
  {
    bdump('renderEdit');
  }
}
