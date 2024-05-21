export const setQuery = (paramName, paramValue) => {
    // Obtenha a URL atual
    let url = new URL(window.location.href);

    // Obtenha os parâmetros de consulta existentes
    let params = new URLSearchParams(url.search);

    // Atualize o valor de um parâmetro existente ou adicione um novo parâmetro
    params.set(paramName, paramValue);

    // Atualize a URL com os novos parâmetros de consulta
    url.search = params.toString();

    // Atualize a URL sem recarregar a página
    window.history.replaceState(null, '', url.href);
}
