<?php

namespace App\Http\Controllers\Api;

use App\API\ApiError;
use App\Disciplina;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DisciplinaController extends Controller
{
	/**
	 * @var Disciplina
	 */
	private $disciplina;

	public function __construct(Disciplina $disciplina)
	{
		$this->disciplina = $disciplina;
	}

	public function index()
    {
    	return response()->json($this->disciplina->paginate(10));
    }

    public function show($id)
    {
    	$disciplina = $this->disciplina->find($id);

    	if(! $disciplina) return response()->json(ApiError::errorMessage('Disciplina não encontrada!', 4040), 404);

    	$data = ['data' => $disciplina];
	    return response()->json($data);
    }

    public function store(Request $request)
    {
		try {

			$disciplinaData = $request->all();
			$this->disciplina->create($disciplinaData);

			$return = ['data' => ['msg' => 'Disciplina criada com sucesso!']];
			return response()->json($return, 201);

		} catch (\Exception $e) {
			if(config('app.debug')) {
				return response()->json(ApiError::errorMessage($e->getMessage(), 1010), 500);
			}
			return response()->json(ApiError::errorMessage('Houve um erro ao realizar operação de salvar', 1010),  500);
		}
    }

	public function update(Request $request, $id)
	{
		try {

			$disciplinaData = $request->all();
			$disciplina     = $this->disciplina->find($id);
			$disciplina->update($disciplinaData);

			$return = ['data' => ['msg' => 'Disciplina atualizada com sucesso!']];
			return response()->json($return, 201);

		} catch (\Exception $e) {
			if(config('app.debug')) {
				return response()->json(ApiError::errorMessage($e->getMessage(), 1011),  500);
			}
			return response()->json(ApiError::errorMessage('Houve um erro ao realizar operação de atualizar', 1011), 500);
		}
	}

	public function delete(Disciplina $id)
	{
		try {
			$id->delete();

			return response()->json(['data' => ['msg' => 'Disciplina: ' . $id->nome . ' removida com sucesso!']], 200);

		}catch (\Exception $e) {
			if(config('app.debug')) {
				return response()->json(ApiError::errorMessage($e->getMessage(), 1012),  500);
			}
			return response()->json(ApiError::errorMessage('Houve um erro ao realizar operação de remover', 1012),  500);
		}
	}
}
