export const fechSignatureResult = async () => {

    const rawResponse = await fetch( 
        document.querySelector('form').attributes.action.value ,
        {
            method: "POST",
            headers: { "Content-Type": "application/json" },
            body: JSON.stringify({ signatures: document.querySelector('input[name="signatures"]').value.trim() })
        }
    )

    return await rawResponse.json()
}