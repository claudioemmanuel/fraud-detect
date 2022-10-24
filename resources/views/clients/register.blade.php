@extends('layouts.default')

@section('title')
    Cadastro de clientes
@endsection

@section('content')
    <div class="card mt-5">
        <div class="card-body">

            <h3>
                <small class="text-muted">Dados do Cliente</small>
            </h3>

            <p class="card-text">
            <form id="formClient" class="row g-3 needs-validation" novalidate enctype="multipart/form-data">
                <div class="col-md-4">
                    <div class="form-floating mb-3 has-validation">
                        <input type="text" name="name" class="form-control" id="name" placeholder="" required title="Nome do Cliente">
                        <label for="name">Nome</label>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-floating mb-3 has-validation">
                        <input type="date" name="birth_date" class="form-control" id="birth_date" placeholder="" required title="Data de Nascimento do Cliente">
                        <label for="birth_date">Data de Nascimento</label>
                    </div>
                </div>
                <div class="col-md-4">
                </div>
                <div class="col-md-4">
                    <div class="form-floating mb-3 has-validation">
                        <input type="text" name="rg" class="form-control" id="rg" placeholder="" required title="RG do Cliente">
                        <label for="rg">RG</label>
                        <small>
                            Somente números
                            <i class="fas fa-info-circle"></i>
                        </small>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-floating mb-3 has-validation">
                        <input type="cpf" name="cpf" class="form-control" id="cpf" placeholder="" required title="CPF do Cliente">
                        <label for="cpf">CPF</label>
                        <small>
                            Somente números
                            <i class="fas fa-info-circle"></i>
                        </small>
                    </div>
                </div>

                <hr />

                <h3>
                    <small class="text-muted">
                        Endereço
                    </small>
                </h3>


                <div class="col-md-4">
                    <div class="form-floating mb-3 has-validation">
                        <input type="text" class="form-control" id="postcode" placeholder="" name="postcode" required title="Digite o CEP">
                        <label for="postcode">CEP</label>
                    </div>
                </div>
                <div class="col-md-8">
                    <small>
                        Informe o CEP para preencher automaticamente os campos abaixo. <br />
                        Caso queira preencher manualmente, clique <a href="#" id="manualAddress">aqui</a>. 
                        <i class="fas fa-info-circle"></i>
                    </small>
                </div>
                <div class="col-md-8">
                    <div class="form-floating mb-3 has-validation">
                        <input type="text" name="streetName" class="form-control" id="streetName" placeholder="" required readonly title="Rua">
                        <label for="streetName">Logradouro</label>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-floating mb-3 has-validation">
                        <input type="text" name="buildingNumber" class="form-control" id="buildingNumber" placeholder="" required title="Número">
                        <label for="buildingNumber">Numero</label>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-floating mb-3 has-validation">
                        <input type="text" name="neighborhood" class="form-control" id="neighborhood" placeholder="" required readonly title="Bairro">
                        <label for="neighborhood">Bairro</label>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-floating mb-3 has-validation">
                        <input type="text" name="city" class="form-control" id="city" placeholder="" required readonly title="Cidade">
                        <label for="city">Cidade</label>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-floating mb-3 has-validation">
                        <input type="text" name="state" class="form-control" id="state" placeholder="" required maxlength="2" pattern="[A-Za-z]{2}" title="Informe apenas as duas letras do estado" readonly>
                        <label for="state">UF</label>
                    </div>
                </div>

                <hr />

                <h3>
                    <small class="text-muted">Foto de perfil</small>
                </h3>

                <div class="col-md-4">
                    <div class=" has-validation">
                        <input class="form-control" type="file" id="profile_photo_path" name="profile_photo_path" required>
                    </div>
                </div>

                <div class="col-12">
                    <button class="btn btn-primary" type="submit">
                        Cadastrar
                    </button>
                </div>
            </form>

            </p>
        </div>
    </div>
@endsection

@section('footer')
    <!-- Custom scripts for this template -->
    <script src="{{ asset('js/client.js') }}"></script>
@endsection