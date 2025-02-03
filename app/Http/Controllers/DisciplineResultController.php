<?php
/**
 * DisciplineResultController.php
 *
 * Verwaltet die Ranglisten für einzelne Disziplinen.
 *
 * PHP Version 8.3
 *
 * @category  Controller
 * @package   App\Http\Controllers
 * @author    Display Name <username@example.com>
 * @license   MIT License
 * @link      https://example.com
 */

namespace App\Http\Controllers;

use App\Models\Discipline;
use App\Models\DisciplineResult;

/**
 * Class DisciplineResultController
 *
 * Controller zur Verwaltung der Ranglisten für einzelne Disziplinen.
 *
 * @category  Controller
 * @package   App\Http\Controllers
 * @author    Display Name <username@example.com>
 * @license   MIT License
 * @link      https://example.com
 */
class DisciplineResultController extends Controller
{
    /**
     * Zeigt die Rangliste für eine bestimmte Disziplin an.
     *
     * @param  int  $disciplineId  Die ID der Disziplin
     * @return \Illuminate\View\View
     */
    public function showLeaderboard($disciplineId)
    {
        $discipline = Discipline::findOrFail($disciplineId);

        $results = DisciplineResult::where('discipline_id', $disciplineId)
            ->join('users', 'discipline_results.user_id', '=', 'users.id')
            ->orderBy('discipline_results.points', 'desc')
            ->select('users.name', 'discipline_results.points')
            ->get();

        return view('leaderboard', compact('discipline', 'results'));
    }
}
