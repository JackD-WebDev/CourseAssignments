// CIS-14A-48204
// Jack Daly 🥷 
// CIS 14: Lab 1 
// Updated 09/16/22

const myName = 'Jack';
const item = 'green 🍾 bottle';
let i = 10;

while(i > 0) {

  const pluralVerse = `${myName}'s ${i} ${item}s hanging on the wall,`;
  const singularVerse = `${myName}'s ${i} ${item} hanging on the wall,`;

  if(i === 2) {
    document.write('<p>' + pluralVerse + ' ' + pluralVerse + '</p>');
    i--;
    document.write('<p>And if one ' + item + ` should accidentally fall, There\'ll be ${i} green bottle hanging on the wall.</p>`);
  } else if(i === 1) {
    document.write('<p>' + singularVerse + ' ' + singularVerse + '</p>');
    i--;
    document.write('<p>And if that one ' + item + ` should accidentally fall, There\'ll be no green bottles hanging on the wall.</p>`);
  } else {
    document.write('<p>' + pluralVerse + ' ' + pluralVerse + '</p>');
    i--;
    document.write('<p>And if one ' + item + ` should accidentally fall, There\'ll be ${i} green bottles hanging on the wall.</p>`);
  }
}