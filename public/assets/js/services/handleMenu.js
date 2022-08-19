export function tapFirstStage(){
    document.querySelector('#firstStage').style.fontWeight = '800'
    document.querySelector('#secondStage').style.fontWeight = '400'
    document.querySelector('#btnFormCheckSignatures').innerText = 'Comprobar qué firma gana'
    document.querySelector('input[name="signatures"]').placeholder = 'KN vs NVV'
    document.querySelector('form').attributes.action.value = '/api/v1/first-stage'
}

export function tapSecondStage(){
    document.querySelector('#firstStage').style.fontWeight = '400'
    document.querySelector('#secondStage').style.fontWeight = '800'
    document.querySelector('#btnFormCheckSignatures').innerText = 'Obtener la mínima firma para ganar'
    document.querySelector('input[name="signatures"]').placeholder = 'N#V vs NVV'
    document.querySelector('form').attributes.action.value = '/api/v1/second-stage'
}