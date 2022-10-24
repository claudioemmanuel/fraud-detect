@extends('layouts.default')

@section('title')
    Venda de produtos
@endsection

@section('content')
    <div class="card mt-5">
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    <div id="spinnerLoading" class="text-center">
                        <div class="spinner-border" role="status" style="color: #aa0505">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                    </div>
                    <div class="table-responsive" id="divTableClient">
                        <table class="table table-striped table-hover" id="tableClients">
                            <thead>
                            <tr>
                                <th scope="col"
                                    style="width: 20%; text-align: left; vertical-align: left;"
                                >
                                    Nome</th>
                                <th scope="col"
                                    style="width: 10%; text-align: left; vertical-align: left;"
                                >
                                    Data de Nascimento</th>
                                <th scope="col">RG</th>
                                <th scope="col">CPF</th>
                                <th scope="col">CEP</th>
                                <th scope="col">Logradouro</th>
                                <th scope="col">Número</th>
                                <th scope="col"
                                    style="width: 10%; text-align: left; vertical-align: left;"
                                >
                                    Bairro</th>
                                <th scope="col">Cidade</th>
                                <th scope="col">UF</th>
                                <th scope="col">Ações</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($clients as $item)
                                <tr>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ date('d/m/Y', strtotime($item->birth_date)) }}</td>
                                    <td>{{ $item->rg }}</td>
                                    <td>{{ $item->cpf }}</td>
                                    <td>{{ $item->postcode }}</td>
                                    <td>{{ $item->streetName }}</td>
                                    <td>{{ $item->buildingNumber }}</td>
                                    <td>{{ $item->neighborhood }}</td>
                                    <td>{{ $item->city }}</td>
                                    <td>{{ $item->state }}</td>
                                    <td>
                                        <button class="btn btn-primary"
                                                type="submit"
                                                onclick="handleInitSale({{ $item }})"
                                        >
                                            Vender
                                            <i class="fas fa-dollar-sign"></i>
                                        </button>
                                    </td>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection

@section('footer')
    <!-- Custom scripts for this template -->
    <script src="{{ asset('js/sale.js') }}"></script>
@endsection
