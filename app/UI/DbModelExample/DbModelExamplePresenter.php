<?php declare(strict_types=1);

namespace App\UI\DbModelExample;

use App\Model\Facade\OsobaFacade;
use App\Model\Facade\OsobaVozidloFacade;
use App\Model\Facade\VozidloFacade;
use Nette\Application\UI\Presenter;

/**
 * Class DbModelExamplePresenter
 *
 * @author Roman Piller
 */
final class DbModelExamplePresenter extends Presenter
{
  public function __construct(
    private readonly OsobaFacade $osobaFacade,
    private readonly VozidloFacade $vozidloFacade,
    private readonly OsobaVozidloFacade $osobaVozidloFacade,
  )
  {
    parent::__construct();
  }

  public function renderOsobaDetail(int $osobaId): void
  {
    $this->template->osoba = $this->osobaFacade->getOsobaDetails($osobaId);
  }

  public function renderVozidloDetail(int $vozidloId): void
  {
    $this->template->vozidlo = $this->vozidloFacade->getVozidloDetails($vozidloId);
  }

  public function renderChangeName(int $osobaId): void
  {
    $renderName = 'roman' . random_int(1,100);
    $this->osobaFacade->rename($osobaId, $renderName);
    $this->forward('osobaDetail', ['osobaId' => $osobaId]);
  }

  public function renderChangeModel(int $vozidloId): void
  {
    $models = ['Skoda', 'Audi', 'Fiat', 'Volvo', 'Seat'];
    $renderModel = $models[random_int(0,4)];
    $this->vozidloFacade->changeVozidloModel($vozidloId, $renderModel);
    $this->forward('vozidloDetail', ['vozidloId' => $vozidloId]);
  }

  public function renderShowAssignedVozidlo(int $osobaId): void
  {
    $vozidla = $this->osobaVozidloFacade->listAssignedVozidlo($osobaId);
    $this->template->vozidla = $vozidla;
  }

  public function renderDefault(): void
  {

  }
}
