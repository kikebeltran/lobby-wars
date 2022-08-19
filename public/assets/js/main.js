import { fechSignatureResult } from './services/fechSignature.js'
import { tapSecondStage, tapFirstStage } from './services/handleMenu.js'

function main(){

    let startInterval
    const $resultsContent = document.querySelector('.dashboard__container__result')

    document.querySelector('#firstStage').addEventListener('click', tapFirstStage )
    document.querySelector('#secondStage').addEventListener('click', tapSecondStage )

    document.getElementById('formCheckSignatures').addEventListener(
        'submit', 
        async ( event ) => {
            event.preventDefault();

            const result = await fechSignatureResult()

            if( result.success ){
                $resultsContent.classList.remove("danger")
                $resultsContent.innerText = result.data
            } else{
                $resultsContent.classList.add("danger")
                $resultsContent.innerText = result.message
            }

            if( startInterval ){
                clearInterval( startInterval )
            }
            startInterval = setInterval(() => {
                $resultsContent.innerText = ''
            }, 5000);

        }
    );

}

window.addEventListener('load', main)