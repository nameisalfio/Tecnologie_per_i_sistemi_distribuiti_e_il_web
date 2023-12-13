package metodi;

import java.text.ParseException;
import java.text.SimpleDateFormat;
import java.util.Date;

public class CambioData {
	// trasforma una stringa data italiano in stringa inglese
	// se non si usano questi metodi a volte non necessari
	// si può utilizzare il metodo split() di String (come in altri esercizi svolti)
	public String dataItaToIng(String datait) {
		String stringadataing = null;
		// oggetti di tipo formato data
		// SimpleDateFormat fornisce metodi per formattare ed analizzare date
		SimpleDateFormat formatoita = new SimpleDateFormat("dd/MM/yyyy");
		SimpleDateFormat formatoing = new SimpleDateFormat("yyy-MM-dd");
		try {
			// trasforma in Date una stringa data (datait) applicando il formato
			Date dataita = formatoita.parse(datait);
			// la data (Date) in italiano viene trasformata in stringa data iglese
			stringadataing = formatoing.format(dataita);
		} catch (ParseException e) {
			// TODO Auto-generated catch block
			e.printStackTrace();
		}
		return stringadataing;
	}

	// trasforma una stringa data inglese in stringa italiano
	// se non si usano questi metodi a volte non necessari
	// si pu� utilizzare il metodo split() di String (come in altri esercizi svolti)
	public String dataIngToIta(String dataen) {
		String stringadataita = null;
		// oggetti di tipo formato data
		SimpleDateFormat formatoita = new SimpleDateFormat("dd/MM/yyyy");
		SimpleDateFormat formatoing = new SimpleDateFormat("yyy-MM-dd");
		try {
			Date dataing = formatoing.parse(dataen);
			stringadataita = formatoita.format(dataing);
		} catch (ParseException e) {
			// TODO Auto-generated catch block
			e.printStackTrace();
		}
		return stringadataita;
	}
}
