<!-- formulaire_declaration_naissance.blade.php -->
@extends('layouts.app')

@section('content')
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Formulaire de déclaration de naissance</h3>
            </div>
        </div>

        <div class="clearfix"></div>

        <div class="row">
            <div class="col-md-12 col-sm-12 ">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Déclaration</h2>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <!-- SmartWizard html -->
                        <div id="wizard" class="form_wizard wizard_horizontal">
                            <ul class="wizard_steps">
                                <li>
                                    <a href="#step-1">
                                        <span class="step_no">1</span>
                                        <span class="step_descr">Info Père</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#step-2">
                                        <span class="step_no">2</span>
                                        <span class="step_descr">Info Mère</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#step-3">
                                        <span class="step_no">3</span>
                                        <span class="step_descr">Info Nouveau née</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#step-4">
                                        <span class="step_no">4</span>
                                        <span class="step_descr">Info Déclarant</span>
                                    </a>
                                </li>
                            </ul>

                            <form action="{{ route('naissance.store') }}" method="POST">
                                @csrf
                                <div class="stepContainer">
                                    <div id="step-1">
                                        <h2 class="StepTitle">Partie 1 - Info Père</h2>

                                        <div class="form-group row">
                                            <label class="col-form-label col-md-3 label-align">Prénom du père<span
                                                    class="required">*</span></label>
                                            <div class="col-md-6">
                                                <input type="text" name="prenom_pere" required class="form-control">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-form-label col-md-3 label-align">Nom du père<span
                                                    class="required">*</span></label>
                                            <div class="col-md-6">
                                                <input type="text" name="nom_pere" required class="form-control">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-form-label col-md-3 label-align">Âge du père<span
                                                    class="required">*</span></label>
                                            <div class="col-md-6">
                                                <input type="number" name="age_pere" required class="form-control">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-form-label col-md-3 label-align">Domicile<span
                                                    class="required">*</span></label>
                                            <div class="col-md-6">
                                                <input type="text" name="domicile_pere" required class="form-control">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-form-label col-md-3 label-align">Ethnie<span
                                                    class="required">*</span></label>
                                            <div class="col-md-6">
                                                <input type="text" name="ethnie_pere" required class="form-control">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-form-label col-md-3 label-align">Situation
                                                Matrimoniale</label>
                                            <div class="col-md-6">
                                                <div class="btn-group" data-toggle="buttons">
                                                    <label class="btn btn-outline-secondary">
                                                        <input type="radio" name="situation_matrimoniale_pere"
                                                            value="marie"> Marié
                                                    </label>
                                                    <label class="btn btn-outline-secondary">
                                                        <input type="radio" name="situation_matrimoniale_pere"
                                                            value="celibataire"> Célibataire
                                                    </label>
                                                    <label class="btn btn-outline-secondary">
                                                        <input type="radio" name="situation_matrimoniale_pere"
                                                            value="divorce"> Divorcé
                                                    </label>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-form-label col-md-3 label-align">Niveau Scolaire<span
                                                    class="required">*</span></label>
                                            <div class="col-md-6">
                                                <input type="text" name="niveau_scolaire_pere" required
                                                    class="form-control">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-form-label col-md-3 label-align">Profession<span
                                                    class="required">*</span></label>
                                            <div class="col-md-6">
                                                <input type="text" name="profession_pere" required class="form-control">
                                            </div>
                                        </div>
                                    </div>

                                    <div id="step-2">
                                        <h2 class="StepTitle">Partie 2 - Info Mère</h2>
                                        <div class="form-group row">
                                            <label class="col-form-label col-md-3 label-align">Prénom de la mère<span
                                                    class="required">*</span></label>
                                            <div class="col-md-6">
                                                <input type="text" name="prenom_mere" required class="form-control">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-form-label col-md-3 label-align">Nom de la mère<span
                                                    class="required">*</span></label>
                                            <div class="col-md-6">
                                                <input type="text" name="nom_mere" required class="form-control">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-form-label col-md-3 label-align">Âge de la mère<span
                                                    class="required">*</span></label>
                                            <div class="col-md-6">
                                                <input type="number" name="age_mere" required class="form-control">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-form-label col-md-3 label-align">Domicile<span
                                                    class="required">*</span></label>
                                            <div class="col-md-6">
                                                <input type="text" name="domicile_mere" required class="form-control">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-form-label col-md-3 label-align">Ethnie<span
                                                    class="required">*</span></label>
                                            <div class="col-md-6">
                                                <input type="text" name="ethnie_mere" required class="form-control">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-form-label col-md-3 label-align">Situation
                                                Matrimoniale</label>
                                            <div class="col-md-6">
                                                <div class="btn-group" data-toggle="buttons">
                                                    <label class="btn btn-outline-secondary">
                                                        <input type="radio" name="situation_matrimoniale_mere"
                                                            value="marie"> Mariée
                                                    </label>
                                                    <label class="btn btn-outline-secondary">
                                                        <input type="radio" name="situation_matrimoniale_mere"
                                                            value="celibataire"> Célibataire
                                                    </label>
                                                    <label class="btn btn-outline-secondary">
                                                        <input type="radio" name="situation_matrimoniale_mere"
                                                            value="divorce"> Divorcée
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-form-label col-md-3 label-align">Niveau Scolaire<span
                                                    class="required">*</span></label>
                                            <div class="col-md-6">
                                                <input type="text" name="niveau_scolaire_mere" required
                                                    class="form-control">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-form-label col-md-3 label-align">Profession<span
                                                    class="required">*</span></label>
                                            <div class="col-md-6">
                                                <input type="text" name="profession_mere" required class="form-control">
                                            </div>
                                        </div>
                                    </div>


                                    <div id="step-3">
                                        <h2 class="StepTitle">Partie 3 - Info Du Nouveau Née</h2>
                                        <div class="form-group row">
                                            <label class="col-form-label col-md-3 label-align">Prénom</label>
                                            <div class="col-md-6">
                                                <input type="text" name="prenom_enfant" class="form-control">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-form-label col-md-3 label-align">Nom</label>
                                            <div class="col-md-6">
                                                <input type="text" name="nom_enfant" class="form-control">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-form-label col-md-3 label-align"><span
                                                    class="required">Date de naissance</span></label>
                                            <div class="col-md-6">
                                                <input type="date" name="date_naissance" required class="form-control">
                                            </div>
                                        </div>
                                    </div>



                                    <div id="step-4">
                                        <h2 class="StepTitle">Partie 3 - Info Déclarant</h2>

                                        {{-- Partie declarant --}}
                                        <div class="form-group row">
                                            <label class="col-form-label col-md-3 label-align">Prénom du déclarant<span
                                                    class="required">*</span></label>
                                            <div class="col-md-6">
                                                <input type="text" name="prenom_declarant" required
                                                    class="form-control">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-form-label col-md-3 label-align">Nom du déclarant<span
                                                    class="required">*</span></label>
                                            <div class="col-md-6">
                                                <input type="text" name="nom_declarant" required class="form-control">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-form-label col-md-3 label-align">Âge du déclarant<span
                                                    class="required">*</span></label>
                                            <div class="col-md-6">
                                                <input type="number" name="age_declarant" required class="form-control">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-form-label col-md-3 label-align">Domicile<span
                                                    class="required">*</span></label>
                                            <div class="col-md-6">
                                                <input type="text" name="domicile_declarant" required
                                                    class="form-control">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-form-label col-md-3 label-align">Ethnie<span
                                                    class="required">*</span></label>
                                            <div class="col-md-6">
                                                <input type="text" name="ethnie_declarant" required
                                                    class="form-control">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-md-6 offset-md-3">
                                                <button type="submit" class="btn btn-success">Soumettre</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
@endsection