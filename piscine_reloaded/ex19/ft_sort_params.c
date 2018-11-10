/* ************************************************************************** */
/*                                                                            */
/*                                                        :::      ::::::::   */
/*   ft_sort_params.c                                   :+:      :+:    :+:   */
/*                                                    +:+ +:+         +:+     */
/*   By: malallai <malallai@student.42.fr>          +#+  +:+       +#+        */
/*                                                +#+#+#+#+#+   +#+           */
/*   Created: 2018/11/06 13:31:27 by malallai          #+#    #+#             */
/*   Updated: 2018/11/06 16:14:37 by malallai         ###   ########.fr       */
/*                                                                            */
/* ************************************************************************** */

#include <unistd.h>

void	ft_putchar(char c);

int		ft_strcmp(char *s1, char *s2)
{
	int i;

	i = 0;
	while (s1[i] != '\0' || s2[i] != '\0')
	{
		if (s1[i] != s2[i])
			return (s1[i] - s2[i]);
		i++;
	}
	if ((s1[i] == '\0' && s2[i] != '\0') || (s1[i] != '\0' && s2[i] == '\0'))
		return (s1[i] - s2[i]);
	return (0);
}

void	ft_putstr(char *str)
{
	while (*str != '\0')
	{
		ft_putchar(*str);
		str++;
	}
}

void	display(int argc, char *argv[])
{
	int i;

	i = 0;
	while (++i < argc)
	{
		ft_putstr(argv[i]);
		ft_putchar('\n');
	}
}

int		main(int argc, char *argv[])
{
	int i;

	i = 0;
	while (++i < argc)
	{
		if (i + 1 < argc && ft_strcmp(argv[i + 1], argv[i]) < 0)
		{
			argv[argc + 1] = argv[i];
			argv[i] = argv[i + 1];
			argv[i + 1] = argv[argc + 1];
			i = 0;
		}
	}
	display(argc, argv);
	return (0);
}
