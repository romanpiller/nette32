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
   * @param VozidloRepository $vozidloRepository
   */
  public function __construct(
    private readonly VozidloService $vozidloService,
    private readonly VozidloRepository $vozidloRepository
  )
  {
  }

  /**
   * Zjednodušené API pre získanie detailov vozidla
   *
   * @param int $id
   * @return Vozidlo
   * @throws InvalidArgumentException
   */
  public function getVozidloDetails(int $id): Vozidlo
  {
    return $this->vozidloRepository->findById($id);
  }

  /**
   * Zjednodušené API pre zmenu modelu vozidla
   *
   * @param int    $id
   * @param string $newModel
   * @return void
   * @throws InvalidArgumentException
   */
  public function changeVozidloModel(int $id, string $newModel): void
  {
    $this->vozidloService->updateVozidloModel($id, $newModel);
  }
}
