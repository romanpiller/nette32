<?php declare(strict_types=1);

namespace App\Model\Facade;

use App\Model\Entity\Vozidlo;
use App\Model\Service\OsobaVozidloService;
use App\Model\Service\VozidloService;
use InvalidArgumentException;

/**
 * Class OsobaVozidloService
 *
 * @author Roman Piller
 */
final class OsobaVozidloFacade
{
  public function __construct(
    private readonly OsobaVozidloService $osobaVozidloService,
    private readonly VozidloService $vozidloService,
  )
  {
  }

  /**
   * Zoznam priradenych vozidile danej osobe
   *
   * @param int $osobaId
   * @return Vozidlo[]
   * @throws InvalidArgumentException
   */
  public function listAssignedVozidlo(int $osobaId): array
  {
    $vozidloIds = $this->osobaVozidloService->getVozidloIdsByOsobaId($osobaId);
    $vozidla = [];
    foreach ($vozidloIds as $vozidloId)
    {
      $vozidla[] = $this->vozidloService->getVozidlo($vozidloId);
    }
    return $vozidla;
  }
}
