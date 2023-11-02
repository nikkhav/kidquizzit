<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Database\QueryException;
use Illuminate\Support\Str;

class DatatableController extends Controller
{
    private $namespace = 'App\\Datatable';

    public function handle($datasource)
    {
        $class = $this->namespace . '\\' . Str::ucfirst($datasource) . 'Datatable';

        try {
            return (new $class)->datatable();
        } catch (QueryException $exception) {
            dd($exception);
        } catch (\Exception $exception) {
            dd($exception);
            throw new \Exception('Datatable class `' . $class . '` not found!');
        }
    }

    public function getDataById($datasource, $id)
    {
        $class = $this->namespace . '\\' . Str::ucfirst($datasource) . 'Datatable';

        try {
            // Instantiate the appropriate datatable class
            $datatable = new $class;

            // Retrieve data by ID using the datatable class's getDataById method
            $data = $datatable->getDataById($id);

            // Handle the case when data is not found
            if ($data === null) {
                return response()->json(['error' => 'Data not found'], 404);
            }

            return response()->json($data);
        } catch (QueryException $exception) {
            return response()->json(['error' => 'Query error'], 500);
        } catch (\Exception $exception) {
            return response()->json(['error' => 'Datatable class not found'], 500);
        }
    }
}
