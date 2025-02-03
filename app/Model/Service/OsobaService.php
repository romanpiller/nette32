<?php declare(strict_types=1);

namespace App\Model\Service;

use App\Model\Entity\Vozidlo;
use App\Model\Repository\OsobaRepository;
use App\Model\Repository\OsobaVozidloRepository;
use App\Model\Repository\VozidloRepository;
use InvalidArgumentException;

/**
 * Class OsobaService
 *
 * @author Roman Piller
 */
final class OsobaService
{
  /**
   * Constructor
   *
   * @param OsobaRepository        $osobaRepository
   * @param OsobaVozidloRepository $osobaVozidloRepository
   * @return void
   */
  public function __construct(
    private readonly OsobaRepository $osobaRepository,
    private readonly OsobaVozidloRepository $osobaVozidloRepository,
  )
  {
  }

  /**
   * Rename osoba object
   *
   * @param int    $id
   * @param string $newName
   * @return void
   * @throws InvalidArgumentException
   */
  public function renameOsoba(int $id, string $newName): void
  {
    $osoba = $this->osobaRepository->findById($id);
    $osoba->setName($newName);
    $this->osobaRepository->update($osoba);
  }

  /**
   * Priradí existujúce vozidlo osobe (nastaví cudzí kľúč v tabuľke vozidlo)
   *
   * @param int $osobaId
   * @param int $vozidloId
   * @throws InvalidArgumentException
   */
  public function assignVozidloToOsoba(int $osobaId, int $vozidloId): void
  {
    $this->osobaVozidloRepository->assignVozidlo($osobaId, $vozidloId);
  }
}
