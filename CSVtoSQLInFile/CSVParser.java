import java.io.File;
import java.io.FileNotFoundException;
import java.io.FileReader;
import java.io.FileWriter;
import java.io.IOException;

public class CSVParser {
	private static String outFilepath = "DegreePlannerOut.csv";
	private static String inFilepath = "courses.csv";

	public static void main(String args[]) {
		FileReader in = null;
		FileWriter out = null;
		try {
			in = new FileReader(new File(inFilepath));
			out = new FileWriter (new File(outFilepath));
		} catch (FileNotFoundException e) {
			// TODO Auto-generated catch block
			e.printStackTrace();
		} catch (IOException e) {
			// TODO Auto-generated catch block
			e.printStackTrace();
		}

		char last = 0, current = 0;
		try {
			while (in.ready()) {
				current = (char) in.read();
				if (last ==',' && current ==','){
					out.write("null");
					System.out.print("null");
				}
				out.write(current);
				last = current;
				System.out.print(current);
			}
		} catch (IOException e) {
			// TODO Auto-generated catch block
			e.printStackTrace();
		}
		
		try {
			in.close();
			out.close();
		} catch (IOException e) {
			// TODO Auto-generated catch block
			e.printStackTrace();
		}
	}

}
