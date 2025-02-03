<?php declare(strict_types=1);

namespace App\Model\Service;

use App\Model\Repository\OsobaVozidloRepository;

/**
 * Class OsobaVozidloService
 *
 * @author Roman Piller
 */
final class OsobaVozidloService
{
  public function __construct(private readonly OsobaVozidloRepository $osobaVozidloRepository)
  {

  }

  /**
   * Ziska pole vozidiel priradenych osobe id
   *
   * @param int $osobaId
   * @return int[]
   */
  public function getVozidloIdsByOsobaId(int $osobaId): array
  {
    return $this->osobaVozidloRepository->findIdVozidlaByOsobaId($osobaId);
  }
}
