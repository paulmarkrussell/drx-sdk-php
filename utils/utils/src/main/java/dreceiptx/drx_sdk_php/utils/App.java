package dreceiptx.drx_sdk_php.utils;

import java.io.BufferedReader;
import java.io.BufferedWriter;
import java.io.File;
import java.io.FileInputStream;
import java.io.FileWriter;
import java.io.IOException;
import java.io.InputStreamReader;

/**
 * Hello world!
 *
 */
public class App 
{
	public static void main( String[] args ) throws IOException
	{
		File f = new File("d:\\git_local\\digitalreceipt\\drx-sdk-dotnet\\src\\drx-sdk-dotnet\\Receipt\\Common\\Currency.cs");
		File out = new File("d:\\git_local\\digitalreceipt\\drx-sdk-php\\samples\\currency_out.txt");
		BufferedReader reader = new BufferedReader(new InputStreamReader(new FileInputStream(f)));
		BufferedWriter writer = new BufferedWriter(new FileWriter(out));
		for (String line = reader.readLine(); line != null; line = reader.readLine()) {
			if (line.trim().startsWith("[EnumMember")) {
				String code = line.substring(line.indexOf("=") + 3);
				code = code.substring(0, code.indexOf("\""));
				String name = line.substring(line.lastIndexOf(" "), line.length() - (line.charAt(line.length() - 1) == ','?1:0));
				System.out.println("Code: " + code + " name: " + name);
				writer.write("\tconst " + name + " = \"" + code + "\";\n");
			}
		}
		writer.flush();
		writer.close();
		reader.close();
	}
}
