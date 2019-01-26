import java.io.File;
import java.util.ArrayList;
import java.util.HashMap;
import java.util.Map;
import java.util.Scanner;

public class Seating
{
	public static void main(String[] args)throws Exception
	{
		Scanner file = new Scanner(new File("seating.in"));
		file.nextLine();
		while(file.hasNextLine())
		{
			int n = file.nextInt();
			Map<String, Integer> students = new HashMap<String, Integer>();
			for(int x = 0;x<n;x++)
			{
				students.put(""+file.next().charAt(0)+file.next().charAt(0), file.nextInt());
			}
			file.nextLine();

			ArrayList<String[]> seats = new ArrayList<>();

			while(true)
			{
				String s = file.nextLine();
				if(s.equals("****"))
					break;

				seats.add(s.split(" "));
			}

			boolean isValid = true;

			for(int r = 0;r<seats.size();r++)
			{
				for(int c = 0;c<seats.get(0).length;c++)
				{
					if(seats.get(r)[c].equals("<>"))
						continue;

					int cur = students.get(seats.get(r)[c]);
					try
					{
						if(cur == students.get(seats.get(r+1)[c]))
							isValid = false;
					}
					catch(IndexOutOfBoundsException e){}
					catch(NullPointerException e){}
					try
					{
						if(cur == students.get(seats.get(r-1)[c]))
							isValid = false;
					}
					catch(IndexOutOfBoundsException e){}
					catch(NullPointerException e){}
					try
					{
						if(cur == students.get(seats.get(r)[c+1]))
							isValid = false;
					}
					catch(IndexOutOfBoundsException e){}
					catch(NullPointerException e){}
					try
					{
						if(cur == students.get(seats.get(r)[c-1]))
							isValid = false;
					}
					catch(IndexOutOfBoundsException e){}
					catch(NullPointerException e){}
					try
					{
						if(cur == students.get(seats.get(r+1)[c+1]))
							isValid = false;
					}
					catch(IndexOutOfBoundsException e){}
					catch(NullPointerException e){}
					try
					{
						if(cur == students.get(seats.get(r+1)[c-1]))
							isValid = false;
					}
					catch(IndexOutOfBoundsException e){}
					catch(NullPointerException e){}
					try
					{
						if(cur == students.get(seats.get(r-1)[c+1]))
							isValid = false;
					}
					catch(IndexOutOfBoundsException e){}
					catch(NullPointerException e){}
					try
					{
						if(cur == students.get(seats.get(r-1)[c-1]))
							isValid = false;
					}
					catch(IndexOutOfBoundsException e){}
					catch(NullPointerException e){}
				}
			}
			if(isValid)
				System.out.println("Start the test!");
			else
				System.out.println("Reseat!");
		}
	}
}
