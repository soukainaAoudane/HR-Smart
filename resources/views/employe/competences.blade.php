{{--ressources/views/employe/competences.blade.php--}}
<x-app-layout>
    @php
        $groupes=$competences->groupBy('categorie');
    @endphp
    <form action="{{route('employe.competences.update')}}" method="POST">
        @csrf
        @method('PUT')
        @foreach ($groupes as $categorie=>$comps )
            
           
            <div class="card mb-3 rounded-4">
                <div class="card-body"><h1 class="p-1 rounded-4 bg-info">{{$categorie}}</h1>
                    @foreach ($comps as $competence ) @php
                $niveauActuel=$mesNiveaux[$competence->id]??0;
            @endphp
                    <label  class="fw-bold">{{$competence->nom}}</label>
                    <select name="competences[{{$competence->id}}]" class="form-select mt-2">
                        <option value="0">Selection votre niveau</option>
                        <option value="1" {{$niveauActuel == 1?'selected':''}}> Notion</option>
                        <option value="2" {{$niveauActuel == 2?'selected':''}}> debitant</option>
                        <option value="3" {{$niveauActuel == 3?'selected':''}}> intermediare</option>
                        <option value="4" {{$niveauActuel == 4?'selected':''}}> avance</option>
                        <option value="5" {{$niveauActuel == 5?'selected':''}}> expert</option>
                    </select>
                
        @endforeach</div>
            </div>
        @endforeach

        <input class="bg-primary" type="submit" name="" id=""/>
    </form>
</x-app-layout>