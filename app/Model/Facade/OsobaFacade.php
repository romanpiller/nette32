<?php declare(strict_types=1);

namespace App\Model\Facade;

use App\Model\Entity\Osoba;
use App\Model\Repository\OsobaRepository;
use App\Model\Service\OsobaService;
use InvalidArgumentException;

/**
 * Class OsobaFacade
 *
 * @author Roman Piller
 */
class OsobaFacade
{
  /**
   * Construct
   *
   * @param OsobaService    $osobaService
   * @param OsobaRepository $osobaRepository
   * @return void
   */
  public function __construct(
    private readonly OsobaService $osobaService,
    private readonly OsobaRepository $osobaRepository
  )
  {
  }

  /**
   * Zjednodušené API pre získanie detailov osoby
   *
   * @param int $id
   * @return Osoba
   * @throws InvalidArgumentException
   */
  public function getOsobaDetails(int $id): Osoba
  {
    return $this->osobaRepository->findById($id);
  }

  /**
   * Zjednodušené API pre zmenu mena osoby
   *
   * @param int    $id
   * @param string $newName
   * @return void
   * @throws InvalidArgumentException
   */
  public function rename(int $id, string $newName): void
  {
    $this->osobaService->renameOsoba($id, $newName);
  }

  /**
   * API pre priradenie vozidla osobe
   *
   * @param int $osobaId
   * @param int $vozidloId
   * @return void
   * @throws InvalidArgumentException
   */
  public function assignVehicleToPerson(int $osobaId, int $vozidloId): void
  {
    $this->osobaService->assignVozidloToOsoba($osobaId, $vozidloId);
  }
}
