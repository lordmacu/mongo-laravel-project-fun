@extends('layouts.main')

@section("content")




<individual-site sitedata='{"id":4,"name":"Almacen de pizzas","admin":"86","phone":"8108882562","email":"Fitzroy@almacendepizzas.com","address":"5602, Nicaragua, Palermo Soho, Comuna 14, Palermo","city":{"id":1,"name":"Buenos Aires","created_at":"2018-02-13 23:02:30","updated_at":"2018-02-13 23:02:30"},"lat":"-34.5816732","lon":"-58.4336242","type":12,"services":[{"id":7,"name":"Puesto de trabajo","icon":"https:\/\/s3.amazonaws.com\/staticthigs\/hot_desk.png","created_at":null,"updated_at":null,"pivot":{"site_id":4,"service_id":7}}],"description":"Almacen de Pizzas es el pr\u00f3ximo lugar para tus ideas. Haz de este espacio tu oficina por un dia, una oficina diferente donde podr\u00e1s conectar con otros, enfocarte y buscar la inspiraci\u00f3n. Aqui encontraras un lugar donde trabajar y vivir nuevas experiencias, al tiempo que conectas con otros.","logo":"1522541473_full_1522537700_Logo.png","status_id":2,"created_at":"2018-02-13 23:02:30","updated_at":"2018-04-01 00:11:13","spaces":[{"id":15,"name":"Pizzeria","icon":"","created_at":null,"updated_at":null,"pivot":{"site_id":4,"space_id":15}},{"id":9,"name":"Restaurante","icon":"","created_at":null,"updated_at":null,"pivot":{"site_id":4,"space_id":9}}],"images":[{"id":1386,"site_id":4,"url":"1522537362_Almacen_pizzas_Meetwork_2.png","type":1,"status_id":1,"size":null,"created_at":"2018-03-16 01:28:10","updated_at":"2018-03-31 23:02:42"},{"id":1387,"site_id":4,"url":"1522537362_Almacen_pizzas_Meetwork_1.png","type":1,"status_id":1,"size":null,"created_at":"2018-03-16 01:28:11","updated_at":"2018-03-31 23:02:43"},{"id":1388,"site_id":4,"url":"1522537363_Almacen_pizzas_Meetwork_4.png","type":1,"status_id":1,"size":null,"created_at":"2018-03-16 01:28:13","updated_at":"2018-03-31 23:02:43"},{"id":1389,"site_id":4,"url":"1522537363_Almacen_pizzas_Meetwork_3.png","type":1,"status_id":1,"size":null,"created_at":"2018-03-16 01:28:14","updated_at":"2018-03-31 23:02:44"}],"hours":[],"reviews":[]}'  :id="1" name="name" rsv="0"></individual-site>


@stop

@section("scripts")
<script>
    
    var siteId=3;
    var siteName="aqui";
</script>
@stop 