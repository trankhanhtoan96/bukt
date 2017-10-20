function getExt(fileName) {
    return (/[.]/.exec(fileName)) ? /[^.]+$/.exec(fileName) : 'undefined';
}