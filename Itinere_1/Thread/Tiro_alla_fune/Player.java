import java.util.Random;

public class Player extends Thread
{
    private int id;
    private static volatile int posizione = 0;
    private volatile int vittorie_tp0 = 0;
    private volatile int vittorie_tp1 = 0;
    private static final Object lock = new Object();
    private static final Random random = new Random();
    private static final int MAX_WIN = 10;
    public static int winner = -1;

    Player(int _id) { id = _id; }

    public void run()
    {
        while (true)
        {
            try 
            {
                if(vittorie_tp0 == MAX_WIN || vittorie_tp1 == MAX_WIN) break;

                int recupero = random.nextInt(4);
                int forza = random.nextInt(6);
                Thread.sleep(recupero * 100);

                synchronized (lock)
                {
                    if (id == 0)
                    {
                        if (posizione >= 10)
                        {
                            vittorie_tp1 ++;
                            System.out.println("[tp" + id + "] Ha vinto tp" + (1 - id) + " (tp0: " + vittorie_tp0 + ", tp1: " + vittorie_tp1 + ")");
                            posizione = 0;
                            lock.notify();
                        }
                        else
                        {
                            posizione -= forza;
                            if (posizione <= -10)
                            {
                                vittorie_tp0 ++;
                                System.out.println("[tp" + id + "] Ha vinto tp" + (1 - id) + " (tp0: " + vittorie_tp0 + ", tp1: " + vittorie_tp1 + ")");
                                lock.wait();
                            }
                        }
                    }
                    else if (id == 1)
                    {
                        if (posizione <= -10)
                        {
                            vittorie_tp0 ++;
                            System.out.println("[tp" + id + "] Ha vinto tp" + (1 - id) + " (tp0: " + vittorie_tp0 + ", tp1: " + vittorie_tp1 + ")");
                            posizione = 0;
                            lock.notify();
                        }
                        else
                        {
                            posizione += forza;
                            if (posizione >= 10)
                            {
                                vittorie_tp1 ++;
                                System.out.println("[tp" + id + "] Ha vinto tp" + (1 - id) + " (tp0: " + vittorie_tp0 + ", tp1: " + vittorie_tp1 + ")");
                                lock.wait();
                            }
                        }
                    }
                }
            } 
            catch (Exception e) 
            {
                e.printStackTrace();
            }
            winner = vittorie_tp0 > vittorie_tp1 ? 0 : 1;
        }
    }
}