import java.util.*;
import java.io.*;

public class Terror {

    static char[][] map;
    static int[][] distances;

    public static void main(String[] args) throws Exception {

        Scanner in = new Scanner(new File("terror.in"));
        int num = in.nextInt();

        for(int x = 0; x < num; x++) {
            int rows = in.nextInt();
            int cols = in.nextInt();
            int timeLeft = in.nextInt();
            in.nextLine();

            map = new char[rows][cols];
            distances = new int[rows][cols];

            int sR = 0;
            int sC = 0;
            int registrationR = 0;
            int registrationC = 0;
            ArrayList<Integer> tableR = new ArrayList<>();
            ArrayList<Integer> tableC = new ArrayList<>();

            for(int r = 0; r < rows; r++)
            {
                String s = in.nextLine().replaceAll(" ", "");
                for(int c = 0; c< cols; c++){
                    char path = s.charAt(c);
                    map[r][c] = path;
                    if(path == 'S')
                    {
                       sR = r;
                       sC = c;
                    }
                    else if(path == 'R')
                    {
                      registrationR = r;
                      registrationC = c;
                    }
                    else if(path == 'T')
                    {
                        tableR.add(r);
                        tableC.add(c);
                    }
                }
            }

            int timeSpent = 0;

            resetdMap();

            setDistances(sR,sC,0);
            timeSpent += distances[registrationR][registrationC];

            resetdMap();

            setDistances(registrationR,registrationC,0);

            int minDist = 100;
            for(int i = 0; i< tableR.size(); i++){

                if(distances[tableR.get(i)][tableC.get(i)] < minDist)
                {
                    minDist = distances[tableR.get(i)][tableC.get(i)];
                }
            }
            timeSpent += minDist;

            if(timeSpent + 5 < timeLeft)
            {
                System.out.println("HUZZAH");
            }
            else
            {
                System.out.println("INCONCEIVABLE!!");
            }

        }
        in.close();
    }
    public static void setDistances(int r, int c, int time)
    {
        if(r < 0 || c < 0 || r >= map.length || c>= map[0].length || distances[r][c] < time || map[r][c] == '#')
        {
            return;
        }
        distances[r][c] = time;

        setDistances(r+1, c , time+1);
        setDistances(r-1,c,time+1);
        setDistances(r,c+1,time+1);
        setDistances(r,c-1,time+1);

    }
    public static void resetdMap()
    {
        for(int[] temp : distances)
            Arrays.fill(temp,100);
    }
}
