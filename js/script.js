document.addEventListener('DOMContentLoaded', function() {
  addHandlers();

  if (createTablesFlag) {
    createTables();
  }
});
function addHandlers() {
  [].forEach.call(document.querySelectorAll('.filter-list-item'), function(item) {
    item.onclick = function() {
      item.classList.toggle('focus');
      sortList();
    }
  });
  document.querySelector('.close').onclick = function() {
    this.parentNode.classList.toggle('active');
  };
  document.querySelector('.save').onclick = function() {
    addCity();
  };
  [].forEach.call(document.querySelectorAll('form'), function(item) {
    item.onsubmit = function() {
      event.preventDefault();
      addUser(this);
    }
  });
}

function addCity() {
  let xhr = new XMLHttpRequest(),
    data = document.getElementById('city-new').querySelector('input').value;

  if (data.trim() == '') return;

  xhr.open('POST', 'handlers/add-city.php', true);
  xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
  xhr.send('name=' + data);

  xhr.onreadystatechange = function() {
    if (this.readyState != 4) return;

    if (xhr.status != 200) {
      console.log( xhr.status + ': ' + xhr.statusText );
    } else {
      try {
        data = JSON.parse(xhr.responseText);

        /*создание и вставка элементов подобным образом нужна для того, чтобы вставлять города в начало списков, при этом не сбрасывая их и оставляя формирование элементов на серверной стороне*/
        let optionWrapper = document.createElement('div'),
          liWrapper = document.createElement('div');
        optionWrapper.innerHTML = data['options'];
        liWrapper.innerHTML = data['li'];

        document.getElementById('cities').insertBefore(optionWrapper.children[0], document.querySelector('#cities option'));


        document.getElementById('city-box').insertBefore(liWrapper.children[0], document.querySelector('#city-box li'));

        document.getElementById('city-new').querySelector('input').value = '';

        addHandlers();
      } catch(err) {
        alert('Такой город уже есть');
      } finally {
        document.getElementById('city-new').classList.toggle('active');
      }
    }
  }
}
function addUser(form) {
  let formData = new FormData(form),
    url = form.getAttribute('action'),
    method = form.getAttribute('method'),
    xhr = new XMLHttpRequest;

  xhr.open(method, url, true);
  xhr.send(formData);

  xhr.onreadystatechange = function() {
    if (this.readyState != 4) return;

    if (xhr.status != 200) {
      console.log( xhr.status + ': ' + xhr.statusText );
    } else {
      try {
        let data = JSON.parse(xhr.responseText);
        // console.log(data);
        user_data = data['data'];
        sortList();
        form.reset();
      } catch(err) {
        alert('Заполните все поля');
      }
    }
  }
}
function sortList() {
  let sorted_arr = sortUserArr(),
    str = formUserList(sorted_arr);

  document.getElementById('user_list').innerHTML = str;
}

function sortUserArr() {
  const edu_box = document.getElementById('edu-box'),
    city_box = document.getElementById('city-box');

  let edu_arr = [],
    city_arr = [];

  [].forEach.call(edu_box.querySelectorAll('.focus'), function(item) {
    edu_arr.push(item.innerText);
  });
  [].forEach.call(city_box.querySelectorAll('.focus'), function(item) {
    city_arr.push(item.innerText);
  });

  let sorted_arr = user_data.toArray().filter(function(value) {
    let city_flag = (city_arr.length == 0) ? true : false;

    city_arr.forEach(function(el) {
      if (value.indexOf(el) != -1) {
        city_flag = true;
        return;
      }
    });

    return (city_flag && (edu_arr.indexOf(value[2]) != -1 || edu_arr.length == 0));
  });

  return sorted_arr;
}
function formUserList(sorted_arr) {
  str = '';

  sorted_arr.forEach(elem => {
    str += `
    <tr>
      <td>` + elem[1] + `</td>
      <td>` + elem[2] + `</td>
      <td>` + elem[3] + `</td>
    </tr>`;
  });

  return str;
}
Object.prototype.toArray = function() {
  let arr = [];

  for (var key in this) {
    if (key != 'toArray') {
      arr.push(this[key]);
    }
  }

  return arr;
}
function createTables() {
  let xhr = new XMLHttpRequest();

  xhr.open('POST', 'handlers/create-tables.php', true);
  xhr.send();

  xhr.onreadystatechange = function() {
    if (this.readyState != 4) return;

    if (xhr.status != 200) {
      console.log( xhr.status + ': ' + xhr.statusText );
    } else {
      if (xhr.responseText == 'success') {
        let insertFlag = confirm('Добавить города и образование?');
        if (insertFlag) {
          insertRecords();
        }
      } else {
        alert('Что-то пошло не так. Код ошибки смотрите в консоли.');
        console.log(xhr.responseText);
      }
    }
  }
}
function insertRecords() {
  let xhr = new XMLHttpRequest();

  xhr.open('POST', 'handlers/insert-records.php', true);
  xhr.send();

  xhr.onreadystatechange = function() {
    if (this.readyState != 4) return;

    if (xhr.status != 200) {
      console.log( xhr.status + ': ' + xhr.statusText );
    } else {
      if (xhr.responseText == 'success') {
        alert('Записи успешно добавлены');
        location.reload();
      } else {
        alert('Что-то пошло не так. Код ошибки смотрите в консоли.');
        console.log(xhr.responseText);
      }
    }
  }
}
