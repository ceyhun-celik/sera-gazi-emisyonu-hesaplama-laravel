let selectedData = null

function calculate_co2(fuel_value, amount_of_fuel, unit_value){
    const calculate = fuel_value * amount_of_fuel * unit_value * 0.57
    return isNaN(calculate) ? 0 : calculate
}

function calculate_ch4(fuel_value, amount_of_fuel, unit_value){
    const calculate = fuel_value * amount_of_fuel * unit_value * 0.25
    return isNaN(calculate) ? 0 : calculate
}

function calculate_n2o(fuel_value, amount_of_fuel, unit_value){
    const calculate = fuel_value * amount_of_fuel * unit_value * 0.18
    return isNaN(calculate) ? 0 : calculate
}

function calculate_co2e(fuel_value, amount_of_fuel, unit_value){
    const calculate = fuel_value * amount_of_fuel * unit_value
    return isNaN(calculate) ? 0 : calculate
}

function result(){
    const fuel_value = fuel.options[fuel.selectedIndex].getAttribute('fuel_value')
    const unit_value = units.options[units.selectedIndex].getAttribute('unit_value')

    co2.value  = calculate_co2(fuel_value, amount_of_fuel.value, unit_value)
    ch4.value  = calculate_ch4(fuel_value, amount_of_fuel.value, unit_value)
    n2o.value  = calculate_n2o(fuel_value, amount_of_fuel.value, unit_value)
    co2e.value = calculate_co2e(fuel_value, amount_of_fuel.value, unit_value)
}

function clear(){
    selectedData = null

    facility_id.selectedIndex = null
    year.selectedIndex   = null
    fuel.selectedIndex   = null
    amount_of_fuel.value = ''
    units.selectedIndex  = null

    co2.value  = ''
    ch4.value  = ''
    n2o.value  = ''
    co2e.value = ''
}

function listDataInTable()
{
    fetch('/api/index')
        .then(response => response.json())
        .then(data => {
            let tbody = document.querySelector('tbody')
            tbody.innerHTML = ''

            data.map(element => {
                tbody.innerHTML +=
                    `<tr>
                        <td>${element.facility_id}</td>
                        <td>${element.year_value}</td>
                        <td>${element.fuel_name}</td>
                        <td>${element.amount_of_fuel}</td>
                        <td>${element.unit_name}</td>
                        <td>${calculate_co2(element.fuel_value, element.amount_of_fuel, element.unit_value)}</td>
                        <td>${calculate_ch4(element.fuel_value, element.amount_of_fuel, element.unit_value)}</td>
                        <td>${calculate_n2o(element.fuel_value, element.amount_of_fuel, element.unit_value)}</td>
                        <td>${calculate_co2e(element.fuel_value, element.amount_of_fuel, element.unit_value)}</td>
                        <td class="tableright">
                        <a class="tabbtn" href="javascript:void(0)" onclick="destroy(${element.id})">Sil</a><br>
                        <a class="tabbtn" href="javascript:void(0)" onclick="selectedValueInInputs(${element.id})">Düzenle</a><br>
                        </td>
                    </tr>`
            })
        })
} listDataInTable()

function destroy(id){
    $.ajax({
        url: `/api/destroy/${id}`,
        type: 'DELETE',
        success: function (result) {
            listDataInTable()
        }
    });
}

function selectedValueInInputs(id){
    fetch(`/api/show/${id}`)
        .then(response => response.json())
        .then(data => {
            selectedData = data.id

            for (let i = 0; i < facility_id.options.length; i++) {
                if(facility_id.options[i].value == data.facility_id){
                    facility_id.options[i].selected = true
                    break
                }
            }

            for (let i = 0; i < year.options.length; i++) {
                if(year.options[i].value == data.year_id){
                    year.options[i].selected = true
                    break
                }
            }

            for (let i = 0; i < fuel.options.length; i++) {
                if(fuel.options[i].value == data.fuel_id){
                    fuel.options[i].selected = true
                    break
                }
            }

            for (let i = 0; i < units.options.length; i++) {
                if(units.options[i].value == data.unit_id){
                    units.options[i].selected = true
                    break
                }
            }

            amount_of_fuel.value = data.amount_of_fuel

            result()
        })
}

fuel.addEventListener('change', () => result())
amount_of_fuel.addEventListener('input', () => result())
units.addEventListener('change', () => result())
resetDataConfirmBtn.addEventListener('click', () => clear())

storeFormData.addEventListener('click', function(){
    let data = {
        facility_id: facility_id.options[facility_id.selectedIndex].value,
        year_id: year.options[year.selectedIndex].value,
        fuel_id: fuel.options[fuel.selectedIndex].value,
        amount_of_fuel: amount_of_fuel.value,
        unit_id: units.options[units.selectedIndex].value
    }

    if(selectedData){
        $.ajax({
            url: `/api/update/${selectedData}`,
            type: 'PUT',
            data: data,
            success: function (result){
                listDataInTable()
                clear()
            }
        });
    } else{
        $.post('/api/store', data, function(data, status){
            listDataInTable()
            clear()
        })
    }
})