var parse = document.getElementById('parse8');
var empty = document.getElementById('empty8');
import {Axios} from "axios";
parse.addEventListener('click', parseFunction)
async function parseFunction()  {
    //console.log('test');
    empty.innerHTML = 'Идёт поиск...';
    var data = await axios.post('/ajax/catalog/onliner');
    console.log(data.data);
    empty.innerHTML = data.data;
}
