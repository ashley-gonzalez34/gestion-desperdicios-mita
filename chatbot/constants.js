// Options the user could type in
let date=new Date(); 
var currentdate=new Date().toLocaleDateString();
var time=new Date().toLocaleTimeString();
const prompts = [
    ["hola", "hey", "buenas", "buenos días", "buenas tardes"],
    ["cómo estás", "qué tal la vida", "cómo van las cosas"],
    ["qué haces", "qué pasa", "qué hay de nuevo"],
    ["cuántos años tienes"],
    ["quién eres", "eres humano", "eres un bot", "eres humano o bot"],
    ["quién te creó", "quién te hizo"],
    [
      "tu nombre por favor",
      "tu nombre",
      "puedo saber tu nombre",
      "cuál es tu nombre",
      "cómo te llamas"
    ],
    ["te quiero"],
    ["feliz", "bueno", "divertido", "maravilloso", "fantástico", "genial"],
    ["mal", "aburrido", "cansado"],
    ["ayúdame", "cuéntame una historia", "cuéntame un chiste"],
    ["ah", "sí", "ok", "vale", "bien"],
    ["adiós", "hasta luego", "nos vemos"],
    ["qué debería comer hoy"],
    ["tío"],
    ["qué", "por qué", "cómo", "dónde", "cuándo"],
    ["no", "no estoy seguro", "quizás", "no gracias"],
    [""],
    ["jaja", "ja", "lol", "jeje", "gracioso", "chiste"],
    ["donar comida", "proyecto"],
    ["fecha"],
    ["hora"],
    ["qué puedo donar", "donar"],
    ["confianza en madurai", "ongs en madurai"],
    ["cuenta un chiste"],
    ["cómo puedo empaquetar mis donaciones de comida cocinada o cruda", "donación de comida cocinada", "donar comida cruda"],
    ["cómo se usa mi donación"],
    ["puedo donar comida cocinada"],
    ["cuáles son las pautas para donar"]
]

// Possible responses, in corresponding order

const replies = [
    ["¡Hola!", "¡Buenas!", "¡Hey!", "¡Hola, qué tal!", "¡Qué hay!"],
    [
      "Bien... ¿y tú?",
      "Bastante bien, ¿y tú?",
      "Fantástico, ¿y tú?"
    ],
    [
      "Nada especial",
      "A punto de irme a dormir",
      "¿Puedes adivinar?",
      "La verdad, no lo sé"
    ],
    ["Soy infinito"],
    ["Solo soy un bot", "Soy un bot. ¿Tú qué eres?"],
    ["Kishor y Uppili"],
    ["Soy Chitti"],
    ["Yo también te quiero", "Yo también"],
    ["¿Alguna vez te has sentido mal?", "Me alegro de oírlo"],
    ["¿Por qué?", "¿Por qué? ¡No deberías!", "Intenta ver la tele"],
    ["¿Sobre qué?", "Érase una vez..."],
    ["Cuéntame una historia", "Cuéntame un chiste", "Háblame de ti"],
    ["Adiós", "Hasta luego", "Nos vemos"],
    ["Sushi", "Pizza"],
    ["¡Tío!"],
    ["Buena pregunta"],
    ["Está bien", "Entiendo", "¿De qué quieres hablar?"],
    ["Por favor, di algo :("],
    ["¡Jaja!", "¡Buena esa!"],
    ["El concepto básico de este proyecto de Gestión de Residuos Alimentarios es recoger el exceso/sobras de comida de donantes como hoteles, restaurantes, salones de bodas, etc. y distribuirlo a las personas necesitadas"],
    [currentdate],
    [time],
    ["puedes donar alimentos crudos, cocinados y envasados"],
    ["Madurai Old Age Charitable Trust, 208, East Veli Street, cerca del Hospital Keshavan"],
    ["chiste ja ja..."],
    ["Puedes empaquetar tus donaciones de comida cocinada o cruda en recipientes herméticos como Tupperware o bolsas de plástico. También puedes usar papel de aluminio o film transparente para mantener la comida fresca. Por favor, asegúrate de etiquetar los recipientes con el tipo de comida, la fecha y cualquier instrucción relevante"],
    ["Tu donación se utilizará para apoyar nuestra misión y los diversos programas e iniciativas que tenemos en marcha. Tu donación nos ayudará a seguir proporcionando asistencia y apoyo a los necesitados. Puedes encontrar más información sobre nuestros programas e iniciativas en nuestra página web"],
    ["Sí, puedes donar comida cocinada siempre que esté preparada en una cocina con licencia, empaquetada adecuadamente y mantenida a temperaturas seguras. Por favor, contáctanos para más instrucciones y pautas"],
    ["Al donar ingredientes crudos, por favor asegúrate de que los artículos estén sin abrir y no caducados"]
]

// Random for any other user input

const alternative = [
    "😢 Lo siento, todavía estoy en desarrollo"
]

// Whatever else you want :)

const coronavirus = ["Por favor, quédate en casa", "Usa una mascarilla", "Afortunadamente, yo no tengo COVID", "Estos son tiempos inciertos"]