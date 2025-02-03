<?php declare(strict_types=1);

namespace App\Model\Facade;

use App\Model\Entity\Vozidlo;
use App\Model\Repository\VozidloRepository;
use App\Model\Service\VozidloService;
use InvalidArgumentException;

/**
 * Class VozidloFacade
 *
 * @author Roman Piller
 */
class VozidloFacade
{
  /**
   * Constructor
   *
   * @param VozidloService    $vozidloService
   */
  public function __construct(
    private readonly VozidloService $vozidloService,
  )
  {
  }

  /**
   * Zjednodušené API pre získanie detailov vozidla
   *
   * @param int $vozidloId
   * @return Vozidlo
   * @throws InvalidArgumentException
   */
  public function getVozidloDetails(int $vozidloId): Vozidlo
  {
    return $this->vozidloService->getVozidlo($vozidloId);
  }

  /**
   * Zjednodušené API pre zmenu modelu vozidla
   *
   * @param int    $vozidloId
   * @param string $newModel
   * @return void
   * @throws InvalidArgumentException
   */
  public function changeVozidloModel(int $vozidloId, string $newModel): void
  {
    $this->vozidloService->updateVozidloModel($vozidloId, $newModel);
  }
}
