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
   * @return void
   */
  public function __construct(
    private readonly OsobaService $osobaService,
  )
  {
  }

  /**
   * Zjednodušené API pre získanie detailov osoby
   *
   * @param int $osobaId
   * @return Osoba
   * @throws InvalidArgumentException
   */
  public function getOsobaDetails(int $osobaId): Osoba
  {
    return $this->osobaService->getOsoba($osobaId);
  }

  /**
   * Zjednodušené API pre zmenu mena osoby
   *
   * @param int    $osobaId
   * @param string $newName
   * @return void
   * @throws InvalidArgumentException
   */
  public function rename(int $osobaId, string $newName): void
  {
    $this->osobaService->renameOsoba($osobaId, $newName);
  }
}
