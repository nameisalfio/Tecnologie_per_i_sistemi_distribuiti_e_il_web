package metodi;

import model.Cameriere;

public class LoginDao {
	
	private CameriereDao dao = new CameriereDao();

	public Cameriere cameriere(String user,String password) {
		Cameriere cam= null;
		for(Cameriere ca:dao.lista()) {
			if(ca.getUsername().equals(user)&&ca.getPassword().equals(password))
				cam=ca;
		}
		return cam;		
	}

}
